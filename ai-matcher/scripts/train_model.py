"""
Training script to train the ML model from CAT adoption data
Run this script after collecting enough adoption feedback
"""

import sys
import os
sys.path.insert(0, os.path.dirname(os.path.dirname(os.path.abspath(__file__))))

import pandas as pd
from matcher import CatMatcherML
from config import config
from datetime import datetime

def create_sample_training_data():
    """
    Create sample training data from rule-based matches
    This demonstrates the data structure for training
    """
    print("Creating sample training data...")
    
    sample_data = {
        'user_lifestyle': ['sedentary', 'sedentary', 'moderate', 'active', 'active', 'moderate', 'sedentary', 'active'],
        'user_budget': ['limited', 'moderate', 'generous', 'moderate', 'generous', 'limited', 'moderate', 'generous'],
        'user_home_env': ['apartment', 'house', 'large_house', 'house', 'large_house', 'apartment', 'house', 'large_house'],
        'user_activity': ['little', 'moderate', 'lots', 'lots', 'lots', 'little', 'moderate', 'lots'],
        'user_experience': ['first_time', 'some', 'experienced', 'experienced', 'some', 'first_time', 'some', 'experienced'],
        'cat_personality': ['calm', 'friendly', 'playful', 'energetic', 'playful', 'calm', 'quiet', 'energetic'],
        'cat_health_status': ['Healthy', 'Healthy', 'Treated', 'Healthy', 'Healthy', 'Recovering', 'Healthy', 'Healthy'],
        'cat_size': ['Small', 'Medium', 'Large', 'Medium', 'Large', 'Small', 'Medium', 'Medium'],
        'cat_energy_level': ['Low', 'Medium', 'High', 'High', 'High', 'Low', 'Low', 'High'],
        'cat_temperament_score': [5, 4, 3, 2, 3, 5, 4, 3],
        'success_score': [95, 88, 92, 85, 90, 82, 87, 93]  # Target: adoption satisfaction (0-100)
    }
    
    df = pd.DataFrame(sample_data)
    
    # Save to CSV
    os.makedirs(os.path.dirname(config.DATA_PATH), exist_ok=True)
    df.to_csv(config.DATA_PATH, index=False)
    print(f"Sample data saved to {config.DATA_PATH}")
    print(f"\nData shape: {df.shape}")
    print("\nFirst few rows:")
    print(df.head())
    
    return config.DATA_PATH

def train_model(csv_path=None):
    """Train the ML model"""
    if csv_path is None:
        csv_path = config.DATA_PATH
    
    print(f"\n{'='*60}")
    print(f"Training ML Model - {datetime.now().strftime('%Y-%m-%d %H:%M:%S')}")
    print(f"{'='*60}")
    
    # Initialize matcher
    matcher = CatMatcherML(config.MODEL_PATH)
    
    # Check if data exists
    if not os.path.exists(csv_path):
        print(f"\nNo training data found at {csv_path}")
        print("Creating sample training data...")
        csv_path = create_sample_training_data()
    
    print(f"\nTraining from: {csv_path}")
    try:
        success = matcher.train_from_csv(csv_path)
    except Exception as e:
        print(f"\nException during training: {str(e)}")
        import traceback
        traceback.print_exc()
        success = False
    
    if success:
        print("\n✓ Model training completed successfully!")
        print(f"✓ Model saved to: {config.MODEL_PATH}")
        print(f"✓ Model is ready for predictions")
    else:
        print("\n✗ Model training failed")
        return False
    
    return True

if __name__ == '__main__':
    train_model()
    print("\nDone!")
