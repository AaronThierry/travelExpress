const puppeteer = require('puppeteer');

// Get evaluation data from command line argument
const evaluationData = JSON.parse(process.argv[2]);

const generatePDF = async () => {
    const browser = await puppeteer.launch({
        headless: 'new',
        args: ['--no-sandbox', '--disable-setuid-sandbox']
    });

    const page = await browser.newPage();

    // Build star rating HTML
    const buildStars = (rating, maxRating = 5) => {
        let stars = '';
        for (let i = 1; i <= maxRating; i++) {
            if (i <= rating) {
                stars += '<span style="color: #F59E0B; font-size: 18px;">★</span>';
            } else {
                stars += '<span style="color: #D1D5DB; font-size: 18px;">★</span>';
            }
        }
        return stars;
    };

    // Format date
    const formatDate = (dateString) => {
        if (!dateString) return 'N/A';
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    };

    // Get initials
    const getInitials = (firstName, lastName) => {
        return ((firstName?.charAt(0) || '') + (lastName?.charAt(0) || '')).toUpperCase();
    };

    // Discovery source labels
    const discoveryLabels = {
        'social_media': 'Réseaux sociaux',
        'friend': 'Ami/Connaissance',
        'search': 'Recherche internet',
        'advertisement': 'Publicité',
        'other': 'Autre'
    };

    // Study level labels
    const studyLevelLabels = {
        'licence': 'Licence',
        'master': 'Master',
        'doctorat': 'Doctorat',
        'other': 'Autre'
    };

    const evaluation = evaluationData;
    const fullName = `${evaluation.first_name || ''} ${evaluation.last_name || ''}`.trim();
    const initials = getInitials(evaluation.first_name, evaluation.last_name);

    const htmlContent = `
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Montserrat', sans-serif;
                background: #ffffff;
                color: #1F2937;
                line-height: 1.5;
            }

            .container {
                width: 100%;
                max-width: 800px;
                margin: 0 auto;
                padding: 0;
            }

            /* Header Section */
            .header {
                background: linear-gradient(135deg, #059669 0%, #047857 50%, #065F46 100%);
                padding: 30px 40px;
                position: relative;
                overflow: hidden;
            }

            .header::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -10%;
                width: 300px;
                height: 300px;
                background: rgba(255,255,255,0.1);
                border-radius: 50%;
            }

            .header::after {
                content: '';
                position: absolute;
                bottom: -30%;
                left: 10%;
                width: 200px;
                height: 200px;
                background: rgba(255,255,255,0.05);
                border-radius: 50%;
            }

            .header-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                position: relative;
                z-index: 1;
            }

            .logo-section h1 {
                font-family: 'Playfair Display', serif;
                font-size: 28px;
                font-weight: 700;
                color: #ffffff;
                letter-spacing: 1px;
            }

            .logo-section p {
                font-size: 11px;
                color: rgba(255,255,255,0.85);
                letter-spacing: 3px;
                text-transform: uppercase;
                margin-top: 4px;
            }

            .doc-badge {
                background: rgba(255,255,255,0.2);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255,255,255,0.3);
                border-radius: 12px;
                padding: 12px 20px;
                text-align: center;
            }

            .doc-badge-label {
                font-size: 9px;
                color: rgba(255,255,255,0.8);
                text-transform: uppercase;
                letter-spacing: 2px;
            }

            .doc-badge-number {
                font-size: 20px;
                font-weight: 700;
                color: #ffffff;
                margin-top: 2px;
            }

            /* Profile Section */
            .profile-section {
                display: flex;
                align-items: flex-start;
                gap: 30px;
                padding: 30px 40px;
                background: #F9FAFB;
                border-bottom: 1px solid #E5E7EB;
            }

            .avatar {
                width: 90px;
                height: 90px;
                border-radius: 50%;
                background: linear-gradient(135deg, #10B981 0%, #059669 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Playfair Display', serif;
                font-size: 32px;
                font-weight: 600;
                color: #ffffff;
                box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
                flex-shrink: 0;
            }

            .profile-info {
                flex: 1;
            }

            .profile-name {
                font-family: 'Playfair Display', serif;
                font-size: 26px;
                font-weight: 600;
                color: #111827;
                margin-bottom: 6px;
            }

            .profile-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 15px;
                font-size: 13px;
                color: #6B7280;
            }

            .profile-meta-item {
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .profile-meta-item svg {
                width: 14px;
                height: 14px;
                color: #9CA3AF;
            }

            .rating-box {
                background: #ffffff;
                border-radius: 16px;
                padding: 20px;
                text-align: center;
                box-shadow: 0 4px 15px rgba(0,0,0,0.08);
                min-width: 140px;
            }

            .rating-score {
                font-size: 42px;
                font-weight: 800;
                color: #059669;
                line-height: 1;
            }

            .rating-max {
                font-size: 18px;
                color: #9CA3AF;
                font-weight: 400;
            }

            .rating-stars {
                margin: 8px 0;
            }

            .recommend-badge {
                display: inline-block;
                padding: 6px 14px;
                border-radius: 20px;
                font-size: 10px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-top: 8px;
            }

            .recommend-yes {
                background: #D1FAE5;
                color: #065F46;
            }

            .recommend-no {
                background: #FEE2E2;
                color: #991B1B;
            }

            /* Content Grid */
            .content-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 25px;
                padding: 30px 40px;
            }

            .info-card {
                background: #ffffff;
                border: 1px solid #E5E7EB;
                border-radius: 12px;
                padding: 18px;
            }

            .info-card-header {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 12px;
            }

            .info-card-icon {
                width: 36px;
                height: 36px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .info-card-icon svg {
                width: 18px;
                height: 18px;
                color: #ffffff;
            }

            .icon-education { background: linear-gradient(135deg, #3B82F6, #1D4ED8); }
            .icon-location { background: linear-gradient(135deg, #8B5CF6, #6D28D9); }
            .icon-discovery { background: linear-gradient(135deg, #F59E0B, #D97706); }
            .icon-date { background: linear-gradient(135deg, #EC4899, #BE185D); }

            .info-card-title {
                font-size: 10px;
                color: #9CA3AF;
                text-transform: uppercase;
                letter-spacing: 1.5px;
            }

            .info-card-value {
                font-size: 15px;
                font-weight: 600;
                color: #111827;
                margin-top: 2px;
            }

            /* Testimonial Section */
            .testimonial-section {
                padding: 0 40px 30px;
            }

            .testimonial-card {
                background: linear-gradient(135deg, #F0FDF4 0%, #ECFDF5 100%);
                border: 1px solid #A7F3D0;
                border-radius: 16px;
                padding: 25px;
                position: relative;
            }

            .quote-icon {
                position: absolute;
                top: 15px;
                left: 20px;
                font-family: 'Playfair Display', serif;
                font-size: 60px;
                color: #10B981;
                opacity: 0.2;
                line-height: 1;
            }

            .testimonial-label {
                font-size: 10px;
                color: #059669;
                text-transform: uppercase;
                letter-spacing: 2px;
                font-weight: 600;
                margin-bottom: 12px;
            }

            .testimonial-text {
                font-size: 15px;
                color: #374151;
                line-height: 1.7;
                font-style: italic;
                padding-left: 10px;
            }

            /* Comments Section */
            .comments-section {
                padding: 0 40px 30px;
            }

            .comments-card {
                background: #FFFBEB;
                border: 1px solid #FDE68A;
                border-radius: 12px;
                padding: 20px;
            }

            .comments-label {
                font-size: 10px;
                color: #B45309;
                text-transform: uppercase;
                letter-spacing: 2px;
                font-weight: 600;
                margin-bottom: 10px;
            }

            .comments-text {
                font-size: 14px;
                color: #78350F;
                line-height: 1.6;
            }

            /* Signature Section */
            .signature-section {
                padding: 0 40px 30px;
                display: flex;
                justify-content: flex-end;
            }

            .signature-box {
                text-align: center;
            }

            .signature-label {
                font-size: 10px;
                color: #9CA3AF;
                text-transform: uppercase;
                letter-spacing: 2px;
                margin-bottom: 8px;
            }

            .signature-image {
                width: 150px;
                height: 60px;
                object-fit: contain;
                border-bottom: 2px solid #E5E7EB;
            }

            .signature-placeholder {
                width: 150px;
                height: 60px;
                border: 2px dashed #D1D5DB;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #9CA3AF;
                font-size: 12px;
            }

            /* Footer */
            .footer {
                background: #111827;
                padding: 20px 40px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .footer-brand {
                font-family: 'Playfair Display', serif;
                font-size: 16px;
                color: #ffffff;
            }

            .footer-info {
                text-align: right;
            }

            .footer-contact {
                font-size: 11px;
                color: #9CA3AF;
            }

            .footer-contact a {
                color: #10B981;
                text-decoration: none;
            }

            .verified-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 8px 16px;
                border-radius: 20px;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-top: 10px;
            }

            .verified-yes {
                background: #D1FAE5;
                color: #065F46;
            }

            .verified-no {
                background: #FEF3C7;
                color: #92400E;
            }

            .verified-badge svg {
                width: 14px;
                height: 14px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <!-- Header -->
            <div class="header">
                <div class="header-content">
                    <div class="logo-section">
                        <h1>Travel Express</h1>
                        <p>Burkina Faso</p>
                    </div>
                    <div class="doc-badge">
                        <div class="doc-badge-label">Évaluation N°</div>
                        <div class="doc-badge-number">${String(evaluation.id).padStart(4, '0')}</div>
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="profile-section">
                <div class="avatar">${initials}</div>
                <div class="profile-info">
                    <div class="profile-name">${fullName || 'Anonyme'}</div>
                    <div class="profile-meta">
                        <span class="profile-meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            ${evaluation.email || 'N/A'}
                        </span>
                        ${evaluation.phone ? `
                        <span class="profile-meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            ${evaluation.phone}
                        </span>
                        ` : ''}
                    </div>
                    <div class="verified-badge ${evaluation.is_verified ? 'verified-yes' : 'verified-no'}">
                        ${evaluation.is_verified ? `
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Vérifiée
                        ` : `
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            En attente
                        `}
                    </div>
                </div>
                <div class="rating-box">
                    <div class="rating-score">${evaluation.rating || 0}<span class="rating-max">/5</span></div>
                    <div class="rating-stars">${buildStars(evaluation.rating || 0)}</div>
                    <div class="recommend-badge ${evaluation.would_recommend ? 'recommend-yes' : 'recommend-no'}">
                        ${evaluation.would_recommend ? '✓ Recommande' : '✗ Ne recommande pas'}
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon icon-education">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>
                        <div>
                            <div class="info-card-title">Université</div>
                            <div class="info-card-value">${evaluation.university || 'N/A'}</div>
                        </div>
                    </div>
                    <div style="font-size: 12px; color: #6B7280; margin-top: 5px;">
                        Niveau: <strong>${studyLevelLabels[evaluation.study_level] || evaluation.study_level || 'N/A'}</strong>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon icon-location">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="info-card-title">Pays d'études</div>
                            <div class="info-card-value">${evaluation.country_of_study || 'N/A'}</div>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon icon-discovery">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="info-card-title">Source de découverte</div>
                            <div class="info-card-value">${discoveryLabels[evaluation.discovery_source] || evaluation.discovery_source || 'N/A'}</div>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon icon-date">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <div class="info-card-title">Date de soumission</div>
                            <div class="info-card-value">${formatDate(evaluation.created_at)}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial -->
            ${evaluation.testimonial ? `
            <div class="testimonial-section">
                <div class="testimonial-card">
                    <div class="quote-icon">"</div>
                    <div class="testimonial-label">Témoignage</div>
                    <div class="testimonial-text">${evaluation.testimonial}</div>
                </div>
            </div>
            ` : ''}

            <!-- Comments -->
            ${evaluation.additional_comments ? `
            <div class="comments-section">
                <div class="comments-card">
                    <div class="comments-label">💡 Commentaires additionnels</div>
                    <div class="comments-text">${evaluation.additional_comments}</div>
                </div>
            </div>
            ` : ''}

            <!-- Signature -->
            <div class="signature-section">
                <div class="signature-box">
                    <div class="signature-label">Signature</div>
                    ${evaluation.signature ?
                        `<img src="${evaluation.signature}" class="signature-image" alt="Signature" />` :
                        `<div class="signature-placeholder">Non signée</div>`
                    }
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <div class="footer-brand">Travel Express Burkina Faso</div>
                <div class="footer-info">
                    <div class="footer-contact">
                        <a href="https://travelexpress-bf.com">www.travelexpress-bf.com</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    `;

    await page.setContent(htmlContent, { waitUntil: 'networkidle0' });

    const pdfBuffer = await page.pdf({
        format: 'A4',
        printBackground: true,
        margin: {
            top: '0',
            right: '0',
            bottom: '0',
            left: '0'
        }
    });

    await browser.close();

    // Output base64 encoded PDF
    console.log(pdfBuffer.toString('base64'));
};

generatePDF().catch(err => {
    console.error(err);
    process.exit(1);
});
