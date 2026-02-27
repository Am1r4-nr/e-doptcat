import requests
import json

# Test 1: Health check
print("=== Test 1: Health Check ===")
response = requests.get("http://localhost:5000/health")
print(f"Status: {response.status_code}")
print(f"Response: {response.json()}")

# Test 2: Single prediction
print("\n=== Test 2: Single Cat Prediction ===")
payload = {
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

response = requests.post("http://localhost:5000/api/predict", json=payload)
print(f"Status: {response.status_code}")
result = response.json()
print(f"Response: {json.dumps(result, indent=2)}")

# Test 3: Batch prediction
print("\n=== Test 3: Batch Prediction ===")
batch_payload = {
    "user_prefs": {
        "lifestyle": "active",
        "budget": "generous",
        "home_env": "large_house",
        "activity": "lots",
        "experience": "experienced"
    },
    "cats": [
        {"id": 1, "name": "Mittens", "personality": "calm", "health_status": "Healthy", "size": "Small", "energy_level": "Low", "temperament_score": 5},
        {"id": 2, "name": "Luna", "personality": "energetic", "health_status": "Healthy", "size": "Large", "energy_level": "High", "temperament_score": 4},
        {"id": 3, "name": "Shadow", "personality": "friendly", "health_status": "Healthy", "size": "Medium", "energy_level": "Medium", "temperament_score": 3}
    ]
}

response = requests.post("http://localhost:5000/api/predict-batch", json=batch_payload)
print(f"Status: {response.status_code}")
result = response.json()
print(f"Response: {json.dumps(result, indent=2)}")

print("\n=== All Tests Complete ===")
