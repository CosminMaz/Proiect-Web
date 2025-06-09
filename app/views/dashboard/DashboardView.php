<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CAM Real Estate</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 100px auto 40px;
            padding: 20px;
        }

        .welcome-section {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .welcome-section h1 {
            color: #1d3557;
            margin-bottom: 15px;
        }

        .welcome-section p {
            color: #457b9d;
            font-size: 1.1em;
        }

        .dashboard-actions {
            display: flex;
            gap: 20px;
            margin: 20px 0;
        }

        .action-button {
            background: #457b9d;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
        }

        .action-button:hover {
            background: #1d3557;
        }

        .properties-section {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .properties-section h2 {
            color: #1d3557;
            margin-bottom: 20px;
        }

        .property-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .property-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .property-card:hover {
            transform: translateY(-5px);
        }

        .property-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .property-info {
            padding: 20px;
        }

        .property-info h3 {
            color: #1d3557;
            margin-bottom: 10px;
        }

        .property-info p {
            color: #457b9d;
            margin-bottom: 15px;
        }

        .property-actions {
            display: flex;
            gap: 10px;
        }

        .edit-btn, .delete-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s;
        }

        .edit-btn {
            background: #457b9d;
            color: white;
        }

        .delete-btn {
            background: #e63946;
            color: white;
        }

        .edit-btn:hover {
            background: #1d3557;
        }

        .delete-btn:hover {
            background: #c1121f;
        }

        @media (max-width: 768px) {
            .dashboard-actions {
                flex-direction: column;
            }
            
            .action-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header id="navbar">
        <div class="logo">CAM Real Estate</div>
        <nav>
            <ul>
                <li><a href="<?php echo URLROOT; ?>">Acasă</a></li>
                <li><a href="<?php echo URLROOT; ?>/users/logout">Deconectare</a></li>
            </ul>
        </nav>
    </header>
        
    <div class="dashboard-container"></div>
 
    <script src="<?php echo URLROOT; ?>/public/assets/script.js"></script>
</body>
</html> 