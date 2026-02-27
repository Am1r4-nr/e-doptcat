"""
Flask API server for AI-powered cat matching
Provides endpoints for:
- Predicting compatibility scores
- Training the model
- Recording feedback
"""

from flask import Flask, request, jsonify
from flask_cors import CORS
import json
import os
import sys
from matcher import CatMatcherML
from config import config

app = Flask(__name__)
CORS(app)

# Initialize ML model
matcher = CatMatcherML(config.MODEL_PATH)

@app.route('/health', methods=['GET'])
def health_check():
    """Health check endpoint"""
    return jsonify({
        'status': 'ok',
        'model_trained': matcher.is_trained,
        'model_path': config.MODEL_PATH
    })

@app.route('/api/predict', methods=['POST'])
def predict_match():
    """
    Predict compatibility score between user and cat
    
    Request body:
    {
        "user_prefs": {
            "lifestyle": "moderate",
            "budget": "moderate",
            "home_env": "house",
            "activity": "moderate",
            "experience": "some"
        },
        "cat_data": {
            "id": 1,
            "name": "Mittens",
            "personality": "friendly",
            "health_status": "Healthy",
            "size": "Medium",
            "energy_level": "Medium",
            "temperament_score": 3
        }
    }
    
    Response:
    {
        "cat_id": 1,
        "cat_name": "Mittens",
        "match_score": 85.5,
        "model_used": "gradient_boosting"
    }
    """
    try:
        data = request.get_json()
        
        if not data or 'user_prefs' not in data or 'cat_data' not in data:
            return jsonify({'error': 'Missing required fields'}), 400
        
        user_prefs = data['user_prefs']
        cat_data = data['cat_data']
        
        # Predict score
        score = matcher.predict_match_score(user_prefs, cat_data)
        
        response = {
            'cat_id': cat_data.get('id'),
            'cat_name': cat_data.get('name'),
            'match_score': round(score, 1),
            'model_trained': matcher.is_trained,
            'model_type': 'gradient_boosting' if matcher.model else 'fallback_rule_based'
        }
        
        return jsonify(response), 200
    
    except Exception as e:
        return jsonify({'error': str(e)}), 500

@app.route('/api/predict-batch', methods=['POST'])
def predict_batch():
    """
    Predict scores for multiple cats
    
    Request body:
    {
        "user_prefs": {...},
        "cats": [
            {"id": 1, "name": "Mittens", ...},
            {"id": 2, "name": "Luna", ...}
        ]
    }
    
    Response:
    {
        "results": [
            {"cat_id": 1, "cat_name": "Mittens", "match_score": 85.5},
            {"cat_id": 2, "cat_name": "Luna", "match_score": 78.2}
        ]
    }
    """
    try:
        data = request.get_json()
        
        if not data or 'user_prefs' not in data or 'cats' not in data:
            return jsonify({'error': 'Missing required fields'}), 400
        
        user_prefs = data['user_prefs']
        cats = data['cats']
        
        results = []
        for cat in cats:
            score = matcher.predict_match_score(user_prefs, cat)
            results.append({
                'cat_id': cat.get('id'),
                'cat_name': cat.get('name'),
                'match_score': round(score, 1)
            })
        
        # Sort by match score descending
        results.sort(key=lambda x: x['match_score'], reverse=True)
        
        return jsonify({
            'results': results,
            'model_trained': matcher.is_trained,
            'total_cats': len(results)
        }), 200
    
    except Exception as e:
        return jsonify({'error': str(e)}), 500

@app.route('/api/train', methods=['POST'])
def train_model():
    """
    Train/retrain the model with CSV data
    
    Request body:
    {
        "csv_path": "path/to/training_data.csv"
    }
    """
    try:
        data = request.get_json()
        csv_path = data.get('csv_path', config.DATA_PATH)
        
        if not os.path.exists(csv_path):
            return jsonify({'error': f'CSV file not found: {csv_path}'}), 404
        
        success = matcher.train_from_csv(csv_path)
        
        return jsonify({
            'success': success,
            'message': 'Model trained successfully' if success else 'Failed to train model',
            'model_path': config.MODEL_PATH
        }), 200 if success else 500
    
    except Exception as e:
        return jsonify({'error': str(e)}), 500

@app.route('/api/record-feedback', methods=['POST'])
def record_feedback():
    """
    Record user feedback on adoption outcome
    This data is used to improve the model
    
    Request body:
    {
        "user_id": 1,
        "cat_id": 1,
        "user_prefs": {...},
        "success_score": 85,  # 0-100: how satisfied with match (0=bad, 100=perfect)
        "notes": "Great match!"
    }
    """
    try:
        data = request.get_json()
        
        # This would be saved to database for later training
        # For now, just acknowledge receipt
        print(f"Feedback received: User {data.get('user_id')} - Cat {data.get('cat_id')} - Score {data.get('success_score')}")
        
        return jsonify({
            'success': True,
            'message': 'Feedback recorded successfully'
        }), 200
    
    except Exception as e:
        return jsonify({'error': str(e)}), 500

@app.route('/api/model-info', methods=['GET'])
def model_info():
    """Get information about current model"""
    return jsonify({
        'is_trained': matcher.is_trained,
        'model_path': config.MODEL_PATH,
        'feature_columns': matcher.feature_columns,
        'label_encoders_count': len(matcher.label_encoders)
    }), 200

if __name__ == '__main__':
    print("Starting AI Matcher API Server...")
    print(f"Config: {config.FLASK_ENV}")
    print(f"Model Path: {config.MODEL_PATH}")
    print(f"Data Path: {config.DATA_PATH}")
    
    app.run(
        host='0.0.0.0',
        port=config.API_PORT,
        debug=config.DEBUG
    )
