<?php
include 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $portfolio_name; ?> - Graphic Designer Portfolio</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Skills Section Styles */
        .skills-section-main {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .skills-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .skill-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.6s ease forwards;
        }

        .skill-card:nth-child(1) { animation-delay: 0.1s; }
        .skill-card:nth-child(2) { animation-delay: 0.2s; }
        .skill-card:nth-child(3) { animation-delay: 0.3s; }
        .skill-card:nth-child(4) { animation-delay: 0.4s; }
        .skill-card:nth-child(5) { animation-delay: 0.5s; }
        .skill-card:nth-child(6) { animation-delay: 0.6s; }

        .skill-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .skill-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 20px;
            animation: bounceIn 0.8s ease;
        }

        .skill-label {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .skill-progress {
            width: 100%;
            height: 8px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 10px;
        }

        .skill-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            animation: progressAnimation 1.5s ease-out forwards;
            width: 0;
        }

        .skill-percentage {
            font-size: 0.9rem;
            color: #666;
            margin-top: 8px;
            display: block;
        }

        /* Languages Section Styles */
        .languages-section {
            padding: 80px 0;
            background: white;
        }

        .lang-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 50px;
            margin-top: 50px;
        }

        .language-circle {
            position: relative;
            width: 150px;
            height: 150px;
            opacity: 0;
            transform: scale(0);
            animation: scaleIn 0.6s ease forwards;
        }

        .language-circle:nth-child(1) { animation-delay: 0.2s; }
        .language-circle:nth-child(2) { animation-delay: 0.4s; }
        .language-circle:nth-child(3) { animation-delay: 0.6s; }
        .language-circle:nth-child(4) { animation-delay: 0.8s; }

        .circle-svg {
            transform: rotate(-90deg);
            width: 150px;
            height: 150px;
        }

        .circle-bg {
            fill: none;
            stroke: #e0e0e0;
            stroke-width: 10;
        }

        .circle-progress {
            fill: none;
            stroke: url(#gradient);
            stroke-width: 10;
            stroke-linecap: round;
            stroke-dasharray: 440;
            stroke-dashoffset: 440;
            animation: circleProgress 2s ease-out forwards;
        }

        .language-circle:nth-child(1) .circle-progress { animation-delay: 0.5s; }
        .language-circle:nth-child(2) .circle-progress { animation-delay: 0.7s; }
        .language-circle:nth-child(3) .circle-progress { animation-delay: 0.9s; }
        .language-circle:nth-child(4) .circle-progress { animation-delay: 1.1s; }

        .circle-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .lang-label {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .lang-percentage {
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea;
        }

        /* Projects Section Styles */
        .projects-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .project-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.6s ease forwards;
        }

        .project-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .project-image {
            position: relative;
            width: 100%;
            height: 250px;
            overflow: hidden;
        }

        .project-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .project-card:hover .project-image img {
            transform: scale(1.1);
        }

        .project-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(102, 126, 234, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .project-card:hover .project-overlay {
            opacity: 1;
        }

        .project-view-btn {
            padding: 12px 30px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .project-view-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .project-content {
            padding: 25px;
        }

        .project-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .project-description {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .project-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .project-tag {
            padding: 5px 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* Animations */
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes progressAnimation {
            to {
                width: var(--progress);
            }
        }

        @keyframes scaleIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes circleProgress {
            to {
                stroke-dashoffset: var(--offset);
            }
        }

        /* Certificates Section Styles */
        .portfolio {
            padding: 80px 0;
            background: white;
        }

        .certificates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .certificate-item {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.6s ease forwards;
        }

        .certificate-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .certificate-image-wrapper {
            position: relative;
            width: 100%;
            height: 250px;
            overflow: hidden;
            background: #f5f5f5;
        }

        .certificate-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .certificate-item:hover .certificate-image {
            transform: scale(1.1);
        }

        .certificate-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(102, 126, 234, 0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .certificate-item:hover .certificate-overlay {
            opacity: 1;
        }

        .view-certificate-btn {
            padding: 12px 25px;
            background: white;
            color: #667eea;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .view-certificate-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .certificate-info {
            padding: 20px;
        }

        .certificate-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .certificate-issuer {
            color: #667eea;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .certificate-date {
            color: #999;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* Certificate Modal Styles */
        .certificate-modal {
            display: none;
            position: fixed;
            z-index: 10000;
            padding: 50px 20px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.95);
            animation: fadeIn 0.3s ease;
        }

        .modal-certificate-image {
            margin: auto;
            display: block;
            max-width: 90%;
            max-height: 85vh;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 10px 50px rgba(0,0,0,0.5);
            animation: zoomIn 0.3s ease;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 40px;
            color: #f1f1f1;
            font-size: 50px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
            z-index: 10001;
        }

        .modal-close:hover,
        .modal-close:focus {
            color: #667eea;
        }

        .modal-caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 20px 0;
            font-size: 1.2rem;
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="#home"><?php echo $portfolio_name; ?></a>
            </div>
            <ul class="nav-menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#languages">Languages</a></li>
                <li><a href="#projects">My Projects</a></li>
                <li><a href="#portfolio">Certificates</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-container">
            <div class="hero-content fade-in">
                <h1 class="hero-title"><?php echo $portfolio_name; ?></h1>
                <h2 class="hero-subtitle"><?php echo $job_title; ?></h2>
                <p class="hero-description"><?php echo $hero_description; ?></p>
                <div class="hero-buttons">
                    <a href="#portfolio" class="btn-primary">View My Work</a>
                    <a href="#contact" class="btn-secondary">Get In Touch</a>
                </div>
            </div>
            <div class="hero-image fade-in-right">
                <img src="fa193bfd-24d7-4909-955c-cd2f02a340c8.jpg" alt="<?php echo $portfolio_name; ?>">
                <div class="image-border"></div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title animate-on-scroll">About Me</h2>
                <p class="section-subtitle animate-on-scroll">Get to know me better</p>
            </div>
            <div class="about-content">
                <div class="about-text animate-on-scroll">
                    <p><?php echo $about_description; ?></p>
                    
                    <div class="about-details">
                        <div class="detail-item">
                            <i class="fas fa-graduation-cap"></i>
                            <div>
                                <h4>Education</h4>
                                <ul>
                                    <?php foreach($education as $edu): ?>
                                    <li>
                                        <strong><?php echo $edu['degree']; ?></strong><br>
                                        <?php echo $edu['school']; ?> (<?php echo $edu['years']; ?>)
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="skills-section animate-on-scroll">
                    <h3>Hobbies & Interests</h3>
                    <div class="hobbies">
                        <div class="hobbies-list">
                            <?php foreach($hobbies as $hobby): ?>
                            <span class="hobby-tag"><?php echo $hobby; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="skills-section-main">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title animate-on-scroll">Skills & Expertise</h2>
                <p class="section-subtitle animate-on-scroll">What I'm great at</p>
            </div>
            <div class="skills-container">
                <?php 
                // Define skills with percentages
                $main_skills = [
                    ['name' => 'Graphic Design', 'icon' => 'fas fa-palette', 'percentage' => 95],
                    ['name' => 'UI/UX Design', 'icon' => 'fas fa-pencil-ruler', 'percentage' => 80],
                    ['name' => 'Adobe Photoshop', 'icon' => 'fas fa-adobe', 'percentage' => 95],
                    ['name' => 'Illustrator', 'icon' => 'fas fa-vector-square', 'percentage' => 88],
                    ['name' => 'Web Design', 'icon' => 'fas fa-laptop-code', 'percentage' => 85],
                    ['name' => 'Canva', 'icon' => 'fas fa-copyright', 'percentage' => 92]
                ];
                
                foreach($main_skills as $skill): 
                ?>
                <div class="skill-card">
                    <div class="skill-icon">
                        <i class="<?php echo $skill['icon']; ?>"></i>
                    </div>
                    <div class="skill-label"><?php echo $skill['name']; ?></div>
                    <div class="skill-progress">
                        <div class="skill-progress-bar" style="--progress: <?php echo $skill['percentage']; ?>%"></div>
                    </div>
                    <span class="skill-percentage"><?php echo $skill['percentage']; ?>%</span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Languages Section -->
    <section id="languages" class="languages-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title animate-on-scroll">Languages</h2>
                <p class="section-subtitle animate-on-scroll">Communication proficiency</p>
            </div>
            <div class="lang-container">
                <?php 
                // Define languages with percentages
                $languages = [
                    ['name' => 'Filipino', 'percentage' => 95],
                    ['name' => 'English', 'percentage' => 80],
                   
                ];
                
                foreach($languages as $lang): 
                    $percentage = $lang['percentage'];
                    $circumference = 440;
                    $offset = $circumference - ($circumference * $percentage / 100);
                ?>
                <div class="language-circle">
                    <svg class="circle-svg">
                        <defs>
                            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#667eea;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#764ba2;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <circle class="circle-bg" cx="75" cy="75" r="70"></circle>
                        <circle class="circle-progress" cx="75" cy="75" r="70" style="--offset: <?php echo $offset; ?>"></circle>
                    </svg>
                    <div class="circle-content">
                        <div class="lang-label"><?php echo $lang['name']; ?></div>
                        <div class="lang-percentage"><?php echo $percentage; ?>%</div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- My Projects Section -->
    <section id="projects" class="projects-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title animate-on-scroll">My Projects</h2>
                <p class="section-subtitle animate-on-scroll">Website designs I've created</p>
            </div>
            <div class="projects-grid">
                <?php 
                // Define your website design projects
                $projects = [
                    [
                        'title' => 'E-tapke Website',
                        'description' => 'RFID Enabled Ingress and Egress Monitoring System for SRC Library',
                        'image' => '551867091_1369840581180085_7830343617646226719_n.png',
                        'link' => 'https://etapke.com/',
                        'tags' => ['Web Design', 'UI/UX']
                    ]
                ];
                
                foreach($projects as $index => $project): 
                ?>
                <div class="project-card animate-on-scroll" style="animation-delay: <?php echo $index * 0.1; ?>s">
                    <div class="project-image">
                        <img src="<?php echo $project['image']; ?>" alt="<?php echo $project['title']; ?>">
                        <div class="project-overlay">
                            <a href="<?php echo $project['link']; ?>" target="_blank" class="project-view-btn">
                                <i class="fas fa-external-link-alt"></i> View Project
                            </a>
                        </div>
                    </div>
                    <div class="project-content">
                        <h3 class="project-title"><?php echo $project['title']; ?></h3>
                        <p class="project-description"><?php echo $project['description']; ?></p>
                        <div class="project-tags">
                            <?php foreach($project['tags'] as $tag): ?>
                            <span class="project-tag"><?php echo $tag; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Certificates Section -->
    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title animate-on-scroll">My Certificates</h2>
                <p class="section-subtitle animate-on-scroll">Professional certifications & achievements</p>
            </div>
            <div class="certificates-grid">
                <?php 
                // Define your certificates
                $certificates = [
                    [
                        'title' => 'Graphic Design Certificate',
                        'issuer' => 'Adobe Certified',
                        'image' => '0cc98c66-7677-45f8-943d-62c90a8222ab.jpg',
                        'date' => '2025'
                    ],
                    [
                        'title' => 'RAITE Certificate',
                        'issuer' => 'Coursera',
                        'image' => '1b511ca2-b751-400c-b879-6ca914e938c7.jpg',
                        'date' => '2024'
                    ],
                    [
                        'title' => 'Web Design Certificate',
                        'issuer' => 'Udemy',
                        'image' => '9e371ea8-ca88-4d58-b60a-af720e08422c.jpg',
                        'date' => '2025'
                    ],
                    [
                        'title' => 'Colloquium Certificate',
                        'issuer' => 'Udemy',
                        'image' => '152aabbb-84fb-4df8-b789-d3c059d05d9d.jpg',
                        'date' => '2025'
                    ],
                    [
                        'title' => 'Code Commit Certificate',
                        'issuer' => 'Udemy',
                        'image' => '5811ff1b-3113-4657-a2a2-090d221dff73.jpg',
                        'date' => '2025'
                    ],
                    [
                        'title' => 'PMI Certificate',
                        'issuer' => 'Google',
                        'image' => 'b1d8d79a-078a-437b-8fcf-54b88d66bb5e.jpg',
                        'date' => '2024'
                    ]
                ];
                
                foreach($certificates as $index => $cert): 
                ?>
                <div class="certificate-item animate-on-scroll" style="animation-delay: <?php echo $index * 0.1; ?>s">
                    <div class="certificate-image-wrapper">
                        <img src="<?php echo $cert['image']; ?>" alt="<?php echo $cert['title']; ?>" class="certificate-image">
                        <div class="certificate-overlay">
                            <button class="view-certificate-btn" onclick="openCertificateModal('<?php echo $cert['image']; ?>', '<?php echo $cert['title']; ?>')">
                                <i class="fas fa-search-plus"></i> View Certificate
                            </button>
                        </div>
                    </div>
                    <div class="certificate-info">
                        <h4 class="certificate-title"><?php echo $cert['title']; ?></h4>
                        <p class="certificate-issuer"><?php echo $cert['issuer']; ?></p>
                        <span class="certificate-date"><i class="far fa-calendar"></i> <?php echo $cert['date']; ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Certificate Modal -->
    <div id="certificateModal" class="certificate-modal" onclick="closeCertificateModal()">
        <span class="modal-close">&times;</span>
        <img class="modal-certificate-image" id="modalCertImage" src="" alt="">
        <div class="modal-caption" id="modalCaption"></div>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title animate-on-scroll">Get In Touch</h2>
                <p class="section-subtitle animate-on-scroll">Let's work together</p>
            </div>
            <div class="contact-content">
                <div class="contact-info animate-on-scroll">
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h4>Phone</h4>
                            <p><?php echo $contact_info['phone']; ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email</h4>
                            <p><?php echo $contact_info['email']; ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-globe"></i>
                        <div>
                            <h4>Website</h4>
                            <p><?php echo $contact_info['website']; ?></p>
                        </div>
                    </div>
                </div>
                <form class="contact-form animate-on-scroll" method="POST" action="includes/send_email.php">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> <?php echo $portfolio_name; ?>. All rights reserved.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-behance"></i></a>
                <a href="#"><i class="fab fa-dribbble"></i></a>
            </div>
        </div>
    </footer>

    <script src="js/script.js"></script>
    <script>
        // Certificate Modal Functions
        function openCertificateModal(imageSrc, title) {
            const modal = document.getElementById('certificateModal');
            const modalImg = document.getElementById('modalCertImage');
            const caption = document.getElementById('modalCaption');
            
            modal.style.display = 'block';
            modalImg.src = imageSrc;
            caption.innerHTML = title;
            document.body.style.overflow = 'hidden';
        }

        function closeCertificateModal() {
            const modal = document.getElementById('certificateModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeCertificateModal();
            }
        });
    </script>
</body>
</html>