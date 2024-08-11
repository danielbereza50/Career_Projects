const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const fs = require('fs');
const path = require('path');

const app = express();
const PORT = 5001; // Port for your server

// Use CORS middleware
app.use(cors());
app.use(bodyParser.json());

// Endpoint to handle form submission
app.post('/submit', (req, res) => {
  const data = req.body;

  // Path to data.json file
  const filePath = path.join(__dirname, './data.json');

  fs.readFile(filePath, 'utf8', (err, fileData) => {
    if (err) {
      console.error('Error reading file:', err); // Log error
      return res.status(500).json({ error: 'Error reading file' });
    }

    let json = fileData ? JSON.parse(fileData) : [];
    json.push(data); // Add new entry

    fs.writeFile(filePath, JSON.stringify(json, null, 2), (err) => {
      if (err) {
        console.error('Error writing file:', err); // Log error
        return res.status(500).json({ error: 'Error writing file' });
      }
      res.status(200).json({ message: 'Data saved successfully' });
    });
  });
});

// Start the server
app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});
