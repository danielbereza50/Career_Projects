const express = require('express');
const axios = require('axios');
const app = express();
require('dotenv').config();

app.use(express.json());

app.get('/registry', async (req, res) => {
  try {
    const response = await axios.get('https://orangepeelz.com/admin/api/2023-10/customers.json?limit=50', {
      headers: {
        'X-Shopify-Access-Token': process.env.SHOPIFY_ACCESS_TOKEN,
        'Content-Type': 'application/json'
      }
    });

    res.json(response.data.customers);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
