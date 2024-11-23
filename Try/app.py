from flask import Flask, request, jsonify
from flask_pymongo import PyMongo
from datetime import datetime

# Initialize the Flask app
app = Flask(__name__)

# Configure MongoDB URI (Replace this with your MongoDB URI if using MongoDB Atlas)
app.config["MONGO_URI"] = "mongodb://localhost:27017/blogs"  # Change if using MongoDB Atlas
mongo = PyMongo(app)

# Route to submit a blog
@app.route('/submit-blog', methods=['POST'])
def submit_blog():
    try:
        # Get the title and content from the request
        title = request.json.get('title')
        content = request.json.get('content')

        if not title or not content:
            return jsonify({"error": "Title and content are required!"}), 400
        
        # Insert blog into the MongoDB collection
        blog_data = {
            "title": title,
            "content": content,
            "date": datetime.now()
        }
        mongo.db.blogs.insert_one(blog_data)

        return jsonify({"message": "Blog submitted successfully!"}), 201
    except Exception as e:
        return jsonify({"error": str(e)}), 500

# Route to fetch all blogs (optional)
@app.route('/blogs', methods=['GET'])
def get_blogs():
    try:
        # Retrieve all blogs from MongoDB
        blogs = mongo.db.blogs.find()
        blog_list = []
        for blog in blogs:
            blog_list.append({
                "title": blog["title"],
                "content": blog["content"],
                "date": blog["date"].strftime('%Y-%m-%d %H:%M:%S')  # Format date to string
            })
        return jsonify(blog_list), 200
    except Exception as e:
        return jsonify({"error": str(e)}), 500

# Run the Flask app
if __name__ == '__main__':
    app.run(debug=True, port=5000)
