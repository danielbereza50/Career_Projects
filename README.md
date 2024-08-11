# Career_Projects
A portfolio of past projects, build instructions and platforms are specified at the start of each branch in order to ensure proper compilation.  Everything is situated within its proper branch which is accessed through the drop down.   


Just React.js:

cd /Applications/MAMP/htdocs  

npx create-react-app ticket-network

cd ticket-network

npm start                          

OR


cd /Applications/MAMP/htdocs/ticket-network

npm start 



cd /Applications/MAMP/htdocs/ticket-network/

npm start

cd /Applications/MAMP/htdocs/ticket-network/server

node server.js



Home url: http://localhost:5000/

Pages are "components"


1. Install Node.js and npm on your Mac.

2. Install MongoDB on your Mac or use a cloud-based MongoDB service like MongoDB Atlas.

3. Create a new directory for your project and navigate to it in your terminal.

4. Initialize a new Node.js project using the command npm init.

5. Install the required dependencies for your MERN stack using the following command:

npm install express body-parser mongoose concurrently nodemon

6. Install React.js by running the following command:

npx create-react-app client

7. Create a file called .env in the root directory of your project and add your MongoDB connection string to it using the following format:

MONGO_URI=your-mongodb-connection-string

Replace your-mongodb-connection-string with your actual MongoDB connection string.

8. Open two terminal windows and navigate to your project directory in both of them.

9. In the first terminal window, run the following command to start the Node.js server:

npm run server

10. In the second terminal window, run the following command to start the React.js development server:

npm run client

11. You can now start building your MERN stack application by editing the files in the client and server directories of your project.

Note that the steps for installing Node.js and npm on a Mac may vary depending on your system. You can download and install Node.js and npm from the official Node.js website (https://nodejs.org/en/download/) or by using a package manager like Homebrew (https://brew.sh/), composer might also be required as well for a package manager.


The MERN stack is a popular technology stack for building modern web applications. It is an acronym for four technologies:

   MongoDB: a NoSQL database that stores data in JSON-like documents. It is known for its scalability, flexibility, and ease of use.
   -https://www.mongodb.com/try/download/community
   
      // create a new collection and insert a document
      db.collection("users").insertOne({
        name: "John Doe",
        email: "johndoe@example.com",
        age: 30
      });

 
   Express.js: a web application framework for Node.js that provides features for building robust and scalable APIs.
   -https://expressjs.com/
   
      // create a simple API endpoint
      app.get("/api/users", (req, res) => {
        const users = [
          { name: "John Doe", email: "johndoe@example.com" },
          { name: "Jane Smith", email: "janesmith@example.com" }
        ];
        res.json(users);
      });


   React: a JavaScript library for building user interfaces. It is fast, efficient, and makes it easy to build reusable UI components.
   -https://reactjs.org/
   
      // create a simple component that displays a message
      import React from "react";

      function HelloWorld() {
        return <h1>Hello, World!</h1>;
      }

   
   Node.js: a JavaScript runtime that allows you to build scalable and high-performance applications on the server-side.
   -https://nodejs.org/
   
      // create a simple HTTP server
      const http = require("http");

      const server = http.createServer((req, res) => {
        res.writeHead(200, { "Content-Type": "text/html" });
        res.write("<h1>Hello, World!</h1>");
        res.end();
      });

      server.listen(3000, () => {
        console.log("Server running on port 3000");
      });

   
Together, these technologies provide a powerful toolset for building full-stack web applications. MongoDB serves as the backend database, Express.js provides a framework for building APIs, React is used for the frontend user interface, and Node.js is used for the server-side logic.

One of the main benefits of the MERN stack is its flexibility and ease of use. Since all of the technologies are built using JavaScript, developers can easily switch between frontend and backend development without needing to learn multiple languages. Additionally, the MERN stack provides a great deal of flexibility, allowing developers to choose the specific technologies and tools that best fit their needs.

Overall, the MERN stack has become a popular choice for building modern web applications due to its scalability, flexibility, and ease of use.








