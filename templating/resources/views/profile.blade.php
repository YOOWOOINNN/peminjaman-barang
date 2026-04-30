<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card - {{ auth()->user()->name ?? 'User' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #0a0a0a;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

        /* Static background with gradients and blur */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(102, 126, 234, 0.6), transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(118, 75, 162, 0.5), transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.4), transparent 60%),
                linear-gradient(45deg, rgba(102, 126, 234, 0.2), rgba(118, 75, 162, 0.2));
            backdrop-filter: blur(60px);
            z-index: -1;
        }

        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            pointer-events: none;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.8);
            animation: twinkle infinite;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(0.8); }
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            pointer-events: none;
        }

        .particle:nth-child(1) { width: 4px; height: 4px; top: 10%; left: 20%; }
        .particle:nth-child(2) { width: 6px; height: 6px; top: 30%; left: 70%; }
        .particle:nth-child(3) { width: 3px; height: 3px; top: 60%; left: 40%; }
        .particle:nth-child(4) { width: 5px; height: 5px; top: 80%; left: 10%; }
        .particle:nth-child(5) { width: 7px; height: 7px; top: 50%; left: 90%; }

        .falling-star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.8);
            animation: fall linear infinite;
            z-index: -2;
        }

        @keyframes fall {
            0% { transform: translateY(-10px) translateX(0px); opacity: 1; }
            100% { transform: translateY(100vh) translateX(150px); opacity: 0; }
        }

        .falling-star-right {
            position: absolute;
            width: 2px;
            height: 2px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.8);
            animation: fall-right linear infinite;
            z-index: -2;
        }

        @keyframes fall-right {
            0% { transform: translateY(-10px) translateX(0px); opacity: 1; }
            100% { transform: translateY(100vh) translateX(-150px); opacity: 0; }
        }

        .card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-width: 350px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            z-index: 1;
        }
        
        .card > * {
            position: relative;
            z-index: 2;
        }
        
        .profile-photo-container {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid white;
            object-fit: cover;
            transition: transform 0.3s ease;
            cursor: pointer;
            background-color: #eee;
        }

        .profile-photo:hover { transform: scale(1.05); }
        
        .change-photo-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.3s ease;
            font-size: 16px;
        }
        
        .change-photo-icon:hover { transform: scale(1.1); background-color: rgba(0, 0, 0, 0.7); }
        
        h1 { margin: 0 0 10px 0; font-size: 24px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); text-transform: capitalize; }
        
        .role { font-size: 14px; margin-bottom: 30px; opacity: 0.8; font-style: italic; }
        
        .actions {
            display: flex;
            justify-content: space-around;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .btn-barang-modern {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 12px;
            transition: all 0.3s ease;
            flex: 1;
        }

        .btn-barang-modern:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-history {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 12px;
            color: white;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 15px;
            font-weight: 600;
        }
        
        .btn-history:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: scale(1.02);
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .modal-content { max-width: 90%; max-height: 90%; border-radius: 10px; }
        .modal img { width: 100%; height: auto; border-radius: 10px; }
        .close { position: absolute; top: 10px; right: 25px; color: white; font-size: 35px; font-weight: bold; cursor: pointer; }
        
        @media (max-width: 480px) {
            .card { padding: 20px; }
            .particle, .star { display: none; }
        }
        #photo-input { display: none; }
    </style>
</head>
<body>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    <div id="stars-container"></div>

    <div class="card">
        <div class="profile-photo-container">
            <img class="profile-photo" id="profile-img" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" alt="Profile">
            <span class="change-photo-icon" onclick="document.getElementById('photo-input').click()">
                <i class="fa-solid fa-camera"></i>
            </span>
        </div>

        <h1>{{ auth()->user()->name }}</h1>
        
        <p class="role">{{ auth()->user()->email }}</p>
        
        <div class="actions">
            <a href="{{ url('/dashboard') }}" class="btn-barang-modern">
                <span class="icon">🏠</span>
                <span class="text">Dashboard</span>
            </a>
            <a href="{{ route('productProfile.index') }}" class="btn-barang-modern">
                <span class="icon">📦</span>
                <span class="text">Barang</span>
            </a>
        </div>
        
        <button class="btn-history">
            <i class="fa-solid fa-clock-rotate-left"></i> history peminjaman
        </button>
    </div>

    <div id="photo-modal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-content">
            <img id="modal-img" src="" alt="Profile Photo">
        </div>
    </div>

    <input type="file" id="photo-input" accept="image/*">

    <script>
        const photoInput = document.getElementById('photo-input');
        const profileImg = document.getElementById('profile-img');
        const modal = document.getElementById('photo-modal');
        const modalImg = document.getElementById('modal-img');
        const STORAGE_KEY = 'profilePhoto_' + "{{ auth()->id() }}"; // Kunci unik per user
        const starsContainer = document.getElementById('stars-container');

        window.addEventListener('DOMContentLoaded', () => {
            const savedPhoto = localStorage.getItem(STORAGE_KEY);
            if (savedPhoto) {
                profileImg.src = savedPhoto;
            }
            generateStars(50);
            startFallingStars();
        });

        function generateStars(numStars) {
            for (let i = 0; i < numStars; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                star.style.width = Math.random() * 3 + 1 + 'px';
                star.style.height = star.style.width;
                star.style.top = Math.random() * 100 + '%';
                star.style.left = Math.random() * 100 + '%';
                star.style.animationDelay = Math.random() * 3 + 's';
                star.style.animationDuration = (Math.random() * 2 + 1) + 's';
                starsContainer.appendChild(star);
            }
        }

        function createFallingStar() {
            const star = document.createElement('div');
            star.classList.add('falling-star');
            star.style.left = Math.random() * 30 + '%';
            star.style.animationDuration = (Math.random() * 2 + 1) + 's';
            document.body.appendChild(star);
            setTimeout(() => { star.remove(); }, 3000);
        }

        function createFallingStarRight() {
            const star = document.createElement('div');
            star.classList.add('falling-star-right');
            star.style.right = Math.random() * 30 + '%';
            star.style.animationDuration = (Math.random() * 2 + 1) + 's';
            document.body.appendChild(star);
            setTimeout(() => { star.remove(); }, 3000);
        }

        function startFallingStars() {
            setInterval(() => {
                createFallingStar();
                if (Math.random() > 0.5) {
                    createFallingStarRight();
                }
            }, Math.random() * 2000 + 1000);
        }

        photoInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                const imageData = e.target.result;
                profileImg.src = imageData;
                localStorage.setItem(STORAGE_KEY, imageData);
            };
            reader.readAsDataURL(file);
        });

        profileImg.addEventListener('click', function() {
            if (profileImg.src) {
                modalImg.src = profileImg.src;
                modal.style.display = 'flex';
            }
        });

        function closeModal() { modal.style.display = 'none'; }

        modal.addEventListener('click', function(event) {
            if (event.target === modal) { closeModal(); }
        });
    </script>
</body>
</html>