"""
Cat-Human Compatibility Matcher using scikit-learn
This module handles the machine learning model for predicting adoption compatibility
"""

import numpy as np
import pandas as pd
from sklearn.ensemble import RandomForestRegressor, GradientBoostingRegressor
from sklearn.preprocessing import LabelEncoder
from sklearn.model_selection import train_test_split
from sklearn.metrics import mean_squared_error, r2_score
import joblib
import os
from datetime import datetime
import json


class CatMatcherML:
    """Machine Learning model for cat-human compatibility matching"""
    
    def __init__(self, model_path='models/matcher_model.pkl'):
        self.model_path = model_path
        self.model = None
        self.label_encoders = {}
        self.feature_columns = [
            'user_lifestyle',
            'user_budget',
            'user_home_env',
            'user_activity',
            'user_experience',
            'cat_personality',
            'cat_health_status',
            'cat_size',
            'cat_energy_level',
            'cat_temperament_score'
        ]
        self.is_trained = False
        self.load_model()
    
    def encode_features(self, data, fit=False):
        """
        Encode categorical features using LabelEncoder
        
        Args:
            data (dict): Feature dictionary
            fit (bool): Whether to fit the encoder on new data
        
        Returns:
            pd.DataFrame: Encoded features
        """
        encoded_data = {}
        
        categorical_features = {
            'user_lifestyle': ['sedentary', 'moderate', 'active'],
            'user_budget': ['limited', 'moderate', 'generous'],
            'user_home_env': ['apartment', 'house', 'large_house'],
            'user_activity': ['little', 'moderate', 'lots'],
            'user_experience': ['first_time', 'some', 'experienced'],
            'cat_personality': ['calm', 'friendly', 'playful', 'energetic', 'quiet', 'social', 'lazy', 'affectionate', 'curious', 'independent', 'adventurous'],
            'cat_health_status': ['Healthy', 'Recovering', 'Treated', 'Under Observation'],
            'cat_size': ['Small', 'Medium', 'Large'],
            'cat_energy_level': ['Low', 'Medium', 'High'],
            'cat_temperament_score': [1, 2, 3, 4, 5]  # Numeric
        }
        
        for key in self.feature_columns:
            if key not in data:
                encoded_data[key] = 0
                continue
                
            value = data[key]
            
            # Handle numeric features
            if key == 'cat_temperament_score':
                encoded_data[key] = float(value) if value is not None else 3
            else:
                # Handle categorical features
                if key not in self.label_encoders:
                    self.label_encoders[key] = LabelEncoder()
                    if fit and categorical_features.get(key):
                        self.label_encoders[key].fit(categorical_features[key])
                
                try:
                    encoded_data[key] = self.label_encoders[key].transform([str(value).lower()])[0]
                except ValueError:
                    # If value not in encoder, use default
                    encoded_data[key] = 0
        
        return pd.DataFrame([encoded_data])
    
    def predict_match_score(self, user_prefs, cat_data):
        """
        Predict compatibility score between user and cat
        
        Args:
            user_prefs (dict): User preferences from questionnaire
            cat_data (dict): Cat attributes from database
        
        Returns:
            float: Match score (0-100)
        """
        try:
            # Prepare features
            features = {
                'user_lifestyle': user_prefs.get('lifestyle', 'moderate'),
                'user_budget': user_prefs.get('budget', 'moderate'),
                'user_home_env': user_prefs.get('home_env', 'house'),
                'user_activity': user_prefs.get('activity', 'moderate'),
                'user_experience': user_prefs.get('experience', 'some'),
                'cat_personality': cat_data.get('personality', 'friendly'),
                'cat_health_status': cat_data.get('health_status', 'Healthy'),
                'cat_size': cat_data.get('size', 'Medium'),
                'cat_energy_level': cat_data.get('energy_level', 'Medium'),
                'cat_temperament_score': cat_data.get('temperament_score', 3)
            }
            
            # Encode features
            X = self.encode_features(features, fit=False)
            
            # Predict
            if self.model is None:
                # Fallback to rule-based scoring if model not available
                return self._rule_based_score(user_prefs, cat_data)
            
            prediction = self.model.predict(X)[0]
            # Ensure score is between 0 and 100
            score = max(0, min(100, prediction))
            return float(score)
        
        except Exception as e:
            print(f"Error in prediction: {str(e)}")
            return self._rule_based_score(user_prefs, cat_data)
    
    def _rule_based_score(self, user_prefs, cat_data):
        """Fallback rule-based scoring when ML model unavailable"""
        score = 0
        
        # Lifestyle
        if (user_prefs.get('lifestyle') == 'sedentary' and 
            cat_data.get('personality', '').lower() in ['calm', 'quiet', 'lazy']):
            score += 20
        elif (user_prefs.get('lifestyle') == 'active' and 
              cat_data.get('personality', '').lower() in ['energetic', 'playful']):
            score += 20
        else:
            score += 12
        
        # Budget (health status)
        health = cat_data.get('health_status', 'Healthy')
        budget = user_prefs.get('budget', 'moderate')
        if budget == 'generous' or health == 'Healthy':
            score += 20
        elif budget == 'moderate' and health in ['Healthy', 'Treated']:
            score += 20
        else:
            score += 10
        
        # Home environment
        size = cat_data.get('size', 'Medium')
        home = user_prefs.get('home_env', 'house')
        if home == 'apartment' and size in ['Small', 'Medium']:
            score += 20
        elif home in ['house', 'large_house']:
            score += 20
        else:
            score += 10
        
        # Activity level
        if user_prefs.get('activity') == 'lots' and cat_data.get('energy_level') == 'High':
            score += 20
        elif user_prefs.get('activity') == 'little' and cat_data.get('energy_level') == 'Low':
            score += 20
        else:
            score += 12
        
        # Experience
        if (user_prefs.get('experience') == 'first_time' and 
            cat_data.get('personality', '').lower() in ['friendly', 'calm', 'affectionate']):
            score += 20
        else:
            score += 12
        
        return min(100, score)
    
    def train_from_csv(self, csv_path):
        """
        Train the model from CSV file with historical data
        
        Args:
            csv_path (str): Path to CSV with columns: user matches, cat attributes, successful (0/1)
        """
        try:
            df = pd.read_csv(csv_path)
            
            if df.empty:
                print("No training data available yet. Using fallback mode.")
                self.is_trained = False
                return False
            
            # Prepare features
            X = df[self.feature_columns].copy()  # All 10 features
            y = df['success_score']  # Target: 0-100 compatibility score
            
            # Encode categorical columns
            for col in X.columns:
                if col == 'cat_temperament_score':
                    # This is already numeric, just ensure it's float
                    X[col] = X[col].astype(float)
                elif X[col].dtype in ('object', 'str'):  # Handle both 'object' and 'str' dtypes
                    if col not in self.label_encoders:
                        self.label_encoders[col] = LabelEncoder()
                    X[col] = self.label_encoders[col].fit_transform(X[col].astype(str))
            
            # Train model
            X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)
            
            # Use GradientBoosting for better performance on small datasets
            self.model = GradientBoostingRegressor(
                n_estimators=50,
                learning_rate=0.1,
                max_depth=3,
                random_state=42
            )
            
            self.model.fit(X_train, y_train)
            
            # Evaluate
            y_pred = self.model.predict(X_test)
            mse = mean_squared_error(y_test, y_pred)
            r2 = r2_score(y_test, y_pred)
            
            print(f"Model trained! MSE: {mse:.4f}, R²: {r2:.4f}")
            
            # Save model
            self.save_model()
            self.is_trained = True
            return True
        
        except Exception as e:
            print(f"Error training model: {str(e)}")
            import traceback
            traceback.print_exc()
            self.is_trained = False
            return False
    
    def save_model(self):
        """Save trained model to disk"""
        os.makedirs(os.path.dirname(self.model_path), exist_ok=True)
        joblib.dump({
            'model': self.model,
            'label_encoders': self.label_encoders,
            'timestamp': datetime.now().isoformat()
        }, self.model_path)
        print(f"Model saved to {self.model_path}")
    
    def load_model(self):
        """Load trained model from disk"""
        if os.path.exists(self.model_path):
            try:
                data = joblib.load(self.model_path)
                self.model = data.get('model')
                self.label_encoders = data.get('label_encoders', {})
                self.is_trained = self.model is not None
                print(f"Model loaded from {self.model_path}")
            except Exception as e:
                print(f"Error loading model: {str(e)}")
                self.model = None
                self.is_trained = False
