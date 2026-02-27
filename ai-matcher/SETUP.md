# Real AI Integration Setup Guide

This guide walks you through setting up the complete scikit-learn based AI matching system.

## Architecture Overview

```
┌──────────────────┐
│  Laravel App     │
│  (cats.index)    │
└────────┬─────────┘
         │ HTTP POST
         ▼
┌──────────────────────────────────────┐
│  Flask API (ai-matcher)              │
│  - /api/predict                      │
│  - /api/predict-batch                │
│  - /api/train                        │
│  - /api/record-feedback              │
└────────┬─────────────────────────────┘
         │
         ▼
┌──────────────────────────────────────┐
│  scikit-learn ML Model               │
│  - GradientBoostingRegressor         │
│  - Saved as .pkl file                │
│  - Loads at startup                  │
└────────┬─────────────────────────────┘
         │
         ▼
┌──────────────────────────────────────┐
│  Training Data (CSV)                 │
│  - Adoption outcomes                 │
│  - User satisfaction scores          │
│  - Cat attributes                    │
└──────────────────────────────────────┘
```

## Step 1: Setup Python Environment

### Option A: Windows (with Python installed)

```bash
# Navigate to ai-matcher folder
cd ai-matcher

# Create virtual environment
python -m venv venv

# Activate virtual environment
venv\Scripts\activate

# Install dependencies
pip install -r requirements.txt
```

### Option B: Using WSL/Linux

```bash
cd ai-matcher
python3 -m venv venv
source venv/bin/activate
pip install -r requirements.txt
```

## Step 2: Configure Environment

```bash
# In ai-matcher folder
cp .env.example .env

# Edit .env (optional - defaults work fine):
# FLASK_ENV=development
# AI_API_PORT=5000
```

## Step 3: Run Database Migrations (Laravel)

```bash
cd laravel-app

# Create the new tables for storing preferences and feedback
php artisan migrate
```

This creates:
- `user_ai_preferences` - Stores user questionnaire responses
- `adoption_feedback` - Stores adoption outcomes for training data

## Step 4: Train Initial Model

```bash
# From ai-matcher folder
python scripts/train_model.py
```

This will:
✓ Create sample training data with 8 examples
✓ Train a Gradient Boosting model
✓ Save model to `models/matcher_model.pkl`
✓ Print training metrics (MSE, R²)

**Output:**
```
Model trained! MSE: 12.5, R²: 0.87
✓ Model training completed successfully!
✓ Model saved to: models/matcher_model.pkl
✓ Model is ready for predictions
```

## Step 5: Start the AI API Server

Open a terminal in the `ai-matcher` folder:

```bash
# Make sure venv is activated
python api_server.py
```

**Output:**
```
Starting AI Matcher API Server...
Config: development
Model Path: models/matcher_model.pkl
Data Path: data/training_data.csv
 * Serving Flask app 'api_server'
 * Running on http://0.0.0.0:5000
```

**Keep this terminal open!** The API server must be running for Laravel to communicate with it.

## Step 6: Test the API

In another terminal:

```bash
# Test health check
curl http://localhost:5000/health

# Expected response:
# {"status": "ok", "model_trained": true, "model_path": "..."}
```

## Step 7: Use in Laravel

1. Go to **Cats Page** → http://localhost:8000/cats
2. Click **"Show Recommended"** button
3. Answer the 5 questionnaire questions
4. Click **"Get AI Recommendations"**
5. **Real AI predictions** will appear! 🎉

The system calls the Flask API to get ML model predictions instead of rule-based scoring.

## Step 8: Improve Model Over Time

### Phase 1: Collect Feedback (Initial - 1-2 weeks)
- Users adopt cats
- After adoption, collect satisfaction feedback (0-100 score)
- Store in `adoption_feedback` table via feedback endpoint

### Phase 2: Retrain Model (Weekly/Monthly)
```bash
# Export feedback from Laravel database to training_data.csv
# Then retrain:
python scripts/train_model.py
```

The model will learn patterns:
- Which user preferences lead to successful adoptions
- Which cats make the best matches
- Improve accuracy over time

### Phase 3: Monitor Performance
```bash
# Check model info
curl http://localhost:5000/api/model-info

# Response shows:
# - is_trained: true/false
# - feature_columns: list of 10 features used
# - label_encoders_count: how many features encoded
```

## How the AI Works

### Input Features (10 total)
1. **user_lifestyle** - sedentary/moderate/active
2. **user_budget** - limited/moderate/generous
3. **user_home_env** - apartment/house/large_house
4. **user_activity** - little/moderate/lots
5. **user_experience** - first_time/some/experienced
6. **cat_personality** - friendly, playful, calm, etc.
7. **cat_health_status** - Healthy/Recovering/Treated/Under Observation
8. **cat_size** - Small/Medium/Large
9. **cat_energy_level** - Low/Medium/High (computed from personality)
10. **cat_temperament_score** - 1-5 numeric score

### Output
- **Match Score**: 0-100% (higher = better match)

### Algorithm
- **Model Type**: GradientBoostingRegressor (scikit-learn)
- **Training**: Learns from adoption feedback data
- **Prediction**: Combines all 10 features to predict compatibility

## API Endpoints Reference

### Predict Single Match
```bash
curl -X POST http://localhost:5000/api/predict \
  -H "Content-Type: application/json" \
  -d '{
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
  }'
```

### Predict Multiple Cats
```bash
curl -X POST http://localhost:5000/api/predict-batch \
  -H "Content-Type: application/json" \
  -d '{
    "user_prefs": {...},
    "cats": [
      {"id": 1, "name": "Mittens", ...},
      {"id": 2, "name": "Luna", ...},
      {"id": 3, "name": "Shadow", ...}
    ]
  }'
```

### Record Feedback
```bash
curl -X POST http://localhost:5000/api/record-feedback \
  -H "Content-Type: application/json" \
  -d '{
    "user_id": 1,
    "cat_id": 1,
    "user_prefs": {...},
    "success_score": 95,
    "notes": "Perfect match! Very happy"
  }'
```

### Retrain Model
```bash
curl -X POST http://localhost:5000/api/train \
  -H "Content-Type: application/json" \
  -d '{"csv_path": "data/training_data.csv"}'
```

## Troubleshooting

### API Server Won't Start
```bash
# Check if port 5000 is in use
netstat -ano | findstr :5000  # Windows
lsof -i :5000                 # Mac/Linux

# Change port in .env
AI_API_PORT=5001
```

### Laravel Can't Connect to API
- Ensure Flask API is running (step 5)
- Check `AI_MATCHER_URL` in Laravel `.env`
- Verify firewall allows 0.0.0.0:5000 connections

### Model Not Training
- Check `data/training_data.csv` exists
- Ensure all required columns present
- Look for errors in Python console output

### Low Match Scores / Inaccurate Predictions
- Normal while model has little training data
- Collect 20-50 adoption outcomes
- Retrain model: `python scripts/train_model.py`
- Accuracy improves as data grows

## Files Structure

```
ai-matcher/
├── api_server.py           # Flask API server
├── matcher.py             # ML model logic
├── config.py              # Configuration
├── requirements.txt       # Python dependencies
├── .env.example          # Environment template
├── README.md             # Full documentation
├── SETUP.md              # This file
├── models/
│   └── matcher_model.pkl # Trained model (generated after training)
├── data/
│   └── training_data.csv # Training data (generated after training)
└── scripts/
    └── train_model.py    # Training script
```

## What's Next?

1. ✅ Set up Python + dependencies
2. ✅ Run initial model training
3. ✅ Start Flask API server
4. ✅ Test in Laravel
5. 📊 Collect real adoption feedback
6. 🔄 Retrain model monthly
7. 📈 Monitor accuracy improvements

## Real AI Features

✅ **Trainable**: Learns from real adoption data
✅ **Adaptive**: Improves with more training data
✅ **Scalable**: Handle 100s of cats and users
✅ **Explainable**: Uses interpretable features
✅ **Fallback**: Rule-based scoring if model unavailable
✅ **Flexible**: Easy to add more features/data

---

For more details, see [README.md](README.md)
