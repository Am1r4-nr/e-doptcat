# AI Cat Matcher - Machine Learning Service

Real AI-powered cat adoption matching using scikit-learn and Python.

## Architecture

```
Laravel App
    ↓ (sends preferences + cat data)
Flask API Server (ai-matcher)
    ↓ (processes via ML model)
scikit-learn ML Model
    ↓ (returns match scores)
Laravel App (displays recommendations)
```

## Setup

### 1. Install Dependencies

```bash
cd ai-matcher
pip install -r requirements.txt
```

### 2. Configure Environment

Copy `.env.example` to `.env`:
```bash
cp .env.example .env
```

Edit `.env` with your settings.

### 3. Train the Model

```bash
python scripts/train_model.py
```

This will:
- Create sample training data if none exists
- Train a Gradient Boosting model
- Save the trained model to `models/matcher_model.pkl`

### 4. Start the API Server

```bash
python api_server.py
```

Server will run on `http://localhost:5000`

## API Endpoints

### Health Check
```bash
GET /health
```

### Predict Single Match
```bash
POST /api/predict
Content-Type: application/json

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
```

**Response:**
```json
{
    "cat_id": 1,
    "cat_name": "Mittens",
    "match_score": 85.5,
    "model_trained": true,
    "model_type": "gradient_boosting"
}
```

### Predict Multiple Cats (Batch)
```bash
POST /api/predict-batch
Content-Type: application/json

{
    "user_prefs": {...},
    "cats": [
        {"id": 1, "name": "Mittens", ...},
        {"id": 2, "name": "Luna", ...}
    ]
}
```

**Response:**
```json
{
    "results": [
        {"cat_id": 1, "cat_name": "Mittens", "match_score": 85.5},
        {"cat_id": 2, "cat_name": "Luna", "match_score": 78.2}
    ],
    "model_trained": true,
    "total_cats": 2
}
```

### Record Feedback
```bash
POST /api/record-feedback
Content-Type: application/json

{
    "user_id": 1,
    "cat_id": 1,
    "user_prefs": {...},
    "success_score": 85,
    "notes": "Great match!"
}
```

### Train/Retrain Model
```bash
POST /api/train
Content-Type: application/json

{
    "csv_path": "data/training_data.csv"
}
```

### Model Info
```bash
GET /api/model-info
```

## Training Data Format

Create a CSV file with the following columns:
```
user_lifestyle,user_budget,user_home_env,user_activity,user_experience,cat_personality,cat_health_status,cat_size,cat_energy_level,cat_temperament_score,success_score
sedentary,limited,apartment,little,first_time,calm,Healthy,Small,Low,5,95
moderate,moderate,house,moderate,some,friendly,Healthy,Medium,Medium,4,88
active,generous,large_house,lots,experienced,energetic,Healthy,Large,High,2,90
```

Column guide:
- **user_*** : User preferences from questionnaire
- **cat_*** : Cat attributes from database
- **success_score**: Adoption outcome satisfaction (0-100)
  - 0: Bad match, adoption failed
  - 50: Average match
  - 100: Perfect match, very satisfied

## Model Pipeline

1. **Data Collection**: Collect adoption outcomes and user satisfaction feedback
2. **Feature Engineering**: Encode categorical & numeric features
3. **Training**: Use Gradient Boosting Regressor for predictions
4. **Evaluation**: Measure MSE and R² score on test set
5. **Deployment**: Save model to disk, serve via API
6. **Feedback Loop**: Record new adoptions → retrain model → improve predictions

## Improving Model Accuracy

### Phase 1: Initial Training
- Use rule-based fallback while collecting data
- Gather 20-50 real adoption outcomes

### Phase 2: First Training
```bash
python scripts/train_model.py
```
Accuracy will improve as more data collected.

### Phase 3: Continuous Learning
- Run `/api/record-feedback` endpoint after each adoption
- Retrain model weekly/monthly with new feedback:
```bash
curl -X POST http://localhost:5000/api/train
```

## Model Features

The ML model uses these 10 features:
1. **User Lifestyle** (sedentary/moderate/active)
2. **User Budget** (limited/moderate/generous)
3. **User Home** (apartment/house/large_house)
4. **User Activity Level** (little/moderate/lots)
5. **User Experience** (first_time/some/experienced)
6. **Cat Personality** (calm, friendly, playful, etc.)
7. **Cat Health** (Healthy/Recovering/Treated/Under Observation)
8. **Cat Size** (Small/Medium/Large)
9. **Cat Energy** (Low/Medium/High)
10. **Cat Temperament** (1-5 score)

Output: **Match Score (0-100%)**

## Fallback Mode

When the ML model isn't trained yet, the system uses a rule-based scoring system that provides reasonable predictions while data is collected.

## Integration with Laravel

See `../../laravel-app/app/Http/Controllers/CatController.php` for integration code that calls this API.
