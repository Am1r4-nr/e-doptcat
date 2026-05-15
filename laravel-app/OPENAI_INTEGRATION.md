# OpenAI Integration Guide for e-DoptCat

## Setup Instructions

### 1. Get Your OpenAI API Key
- Visit https://platform.openai.com/api-keys
- Create a new API key
- Copy it and add to your `.env` file

### 2. Add API Key to .env
```env
OPENAI_API_KEY=sk-your-api-key-here
```

### 3. Test the Connection
```bash
php artisan tinker
# Then run:
$service = new \App\Services\OpenAIService();
echo $service->generateCatDescription('Bits', 'Domestic Short Hair', 'Orange');
```

---

## Available Features

### 1. Generate AI Descriptions for Cats
Generate engaging, adoption-friendly descriptions for each cat.

**CLI Command:**
```bash
# Generate for cats without descriptions
php artisan ai:generate-descriptions

# Generate for specific cat
php artisan ai:generate-descriptions --cat-id=1

# Regenerate for all cats
php artisan ai:generate-descriptions --all
```

**API Endpoint:**
```
GET /api/cats/{catId}/description
Headers: Authorization: Bearer {token}
```

**Response:**
```json
{
  "success": true,
  "cat_id": 1,
  "generated_description": "Bits is a beautiful domestic short hair cat..."
}
```

---

### 2. Get Adoption Recommendations
Get AI-powered suggestions for ideal adopter types based on cat personality and health.

**API Endpoint:**
```
GET /api/cats/{catId}/recommendations
Headers: Authorization: Bearer {token}
```

**Response:**
```json
{
  "success": true,
  "cat_id": 1,
  "cat_name": "Bits",
  "recommendations": {
    "recommendations": [
      "Family with experience handling special needs cats",
      "Patient adopter willing to provide ongoing care",
      "Quiet home environment preferred"
    ]
  }
}
```

---

### 3. Generate Medical Summaries
Create concise, easy-to-understand summaries of medical histories.

**API Endpoint:**
```
GET /api/cats/{catId}/medical-summary
Headers: Authorization: Bearer {token}
```

**Response:**
```json
{
  "success": true,
  "cat_id": 1,
  "cat_name": "Bits",
  "medical_summary": "Bits has recovered well from serious health complications including maggot infection and anemia. She requires ongoing monitoring for her previous FIP exposure..."
}
```

---

### 4. Match Cats to Adopter Preferences
Find suitable cats based on adopter preferences and lifestyle.

**API Endpoint:**
```
POST /api/match-cats
Content-Type: application/json

{
  "preferences": "Looking for a calm, gentle cat that's good with children and doesn't require special medical care"
}
```

**Response:**
```json
{
  "success": true,
  "adopter_preferences": "Looking for a calm, gentle cat...",
  "suitable_personalities": {
    "personalities": [
      "Gentle and docile",
      "Social and affectionate",
      "Calm temperament"
    ]
  },
  "total_cats_available": 7,
  "cats": [...]
}
```

---

### 5. Bulk Generate Descriptions
Update descriptions for all cats that don't have them.

**API Endpoint:**
```
POST /api/cats/bulk-generate-descriptions
Headers: Authorization: Bearer {token}
```

**Response:**
```json
{
  "success": true,
  "updated": 3,
  "errors": [],
  "message": "3 cats updated successfully"
}
```

---

## Usage Examples

### Using Laravel Tinker

```bash
php artisan tinker
```

```php
$service = new \App\Services\OpenAIService();

// Generate description
$description = $service->generateCatDescription('Loki', 'Domestic Short Hair', 'Black');

// Get recommendations
$recommendations = $service->suggestAdoptionRecommendations(
    'Loki',
    'Very playful, especially with other cats',
    'Was recovering from ulcers, now awaiting vet approval',
    'N/A'
);

// Generate medical summary
$summary = $service->generateMedicalSummary(
    'Infected area around the ulcers could not be saved and the dead tissues had to be removed...'
);

// Match user to cats
$matches = $service->matchCatsToProfile(
    'Quiet home, experienced cat owner, wants a playful companion'
);
```

### Using cURL

```bash
# Get recommendations for cat with ID 1
curl -X GET http://localhost:8000/api/cats/1/recommendations \
  -H "Authorization: Bearer YOUR_SANCTUM_TOKEN"

# Generate descriptions for all cats needing them
curl -X POST http://localhost:8000/api/cats/bulk-generate-descriptions \
  -H "Authorization: Bearer YOUR_SANCTUM_TOKEN"

# Match cats to preferences
curl -X POST http://localhost:8000/api/match-cats \
  -H "Content-Type: application/json" \
  -d '{"preferences": "Family with young children, needs a calm cat"}'
```

---

## Configuration

### Customize in `.env`:
```env
OPENAI_API_KEY=sk-your-key
# Optional: Change default model (GPT-4 available with higher cost)
# OPENAI_MODEL=gpt-4
```

### Modify behavior in `app/Services/OpenAIService.php`:
- **Temperature**: Controls creativity (0-1, higher = more creative)
- **Max tokens**: Limits response length
- **Model**: Change from gpt-3.5-turbo to gpt-4 for better quality

---

## Cost Considerations

**Current settings use GPT-3.5-Turbo (most economical):**
- ~$0.001 per 1000 input tokens
- ~$0.002 per 1000 output tokens
- Generating 7 cat descriptions: ~$0.02-0.05

**To reduce costs:**
- Cache commonly used prompts
- Batch similar requests
- Use temperature 0.5 for deterministic responses

---

## Error Handling

If you get an error:

1. **"Invalid API key"**: Check your OPENAI_API_KEY in .env
2. **"Rate limit exceeded"**: Wait and retry, or upgrade your OpenAI plan
3. **"Connection timeout"**: Check internet connection and OpenAI status
4. **"No API key found"**: Ensure .env is loaded with `php artisan config:cache`

---

## Best Practices

1. ✅ Validate API responses before saving to database
2. ✅ Use try-catch blocks for API calls
3. ✅ Rate limit requests to avoid hitting OpenAI limits
4. ✅ Cache results to reduce API calls
5. ✅ Test with a small set of data first
6. ✅ Monitor your OpenAI API usage dashboard

---

## Next Steps

1. Add your OpenAI API key to .env
2. Run: `php artisan ai:generate-descriptions`
3. Test endpoints with Postman or curl
4. Integrate into your web interface
5. Monitor API usage at https://platform.openai.com/usage
