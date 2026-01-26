import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// Register Alpine plugins
Alpine.plugin(collapse);

// Evaluation Form Component
Alpine.data('evaluationForm', () => ({
    step: 1,
    totalSteps: 4,
    submitting: false,
    success: false,
    error: null,
    stepValidationAttempted: false,

    // Form data
    firstName: '',
    lastName: '',
    email: '',
    phone: '',

    university: '',
    countryOfStudy: '',
    studyLevel: '',
    fieldOfStudy: '',
    startYear: '',
    serviceUsed: 'etudes',

    projectStory: '',
    discoverySource: '',
    discoverySourceDetail: '',
    ambassadorDirectContact: null,
    conversationScreenshots: [],
    screenshotPreviews: [],

    rating: 5,
    ratingAccompagnement: 5,
    ratingCommunication: 5,
    ratingDelais: 5,
    ratingQualitePrix: 5,
    wouldRecommend: true,

    // Touched states for validation display
    firstNameTouched: false,
    lastNameTouched: false,
    emailTouched: false,
    universityTouched: false,
    countryOfStudyTouched: false,
    studyLevelTouched: false,
    fieldOfStudyTouched: false,
    projectStoryTouched: false,
    discoverySourceTouched: false,

    // Signature
    signatureData: '',
    signatureCanvas: null,
    signatureCtx: null,
    isDrawing: false,
    lastX: 0,
    lastY: 0,
    canvasDpr: 1,
    points: [],
    lastTime: 0,
    lastVelocity: 0,
    baseWidth: 2.5,
    minWidth: 1.2,
    maxWidth: 4.5,
    velocityFilterWeight: 0.7,
    minDistance: 0.5,

    // Validation methods
    get isValidEmail() {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email);
    },
    get isStep1Valid() {
        return this.firstName.trim().length >= 2 &&
               this.lastName.trim().length >= 2 &&
               this.isValidEmail;
    },
    get isStep2Valid() {
        return this.university.trim().length >= 3 &&
               this.countryOfStudy.trim().length >= 2 &&
               this.studyLevel !== '' &&
               this.fieldOfStudy.trim().length >= 2;
    },
    get isStep3Valid() {
        const basicValid = this.projectStory.trim().length >= 50 &&
                          this.discoverySource !== '';
        if (this.isAmbassadorSelected) {
            return basicValid && this.conversationScreenshots.length > 0;
        }
        return basicValid;
    },
    get isStep4Valid() {
        return this.signatureData !== '';
    },
    get isAmbassadorSelected() {
        return this.discoverySource === 'ambassadeur_la_bobolaise' ||
               this.discoverySource === 'ambassadeur_ley_ley' ||
               this.discoverySource === 'ambassadeur_autre';
    },

    getStepErrors() {
        let errors = [];
        if (this.step === 1) {
            if (this.firstName.trim().length < 2) errors.push('Prénom (min. 2 caractères)');
            if (this.lastName.trim().length < 2) errors.push('Nom (min. 2 caractères)');
            if (!this.isValidEmail) errors.push('Email valide requis');
        } else if (this.step === 2) {
            if (this.university.trim().length < 3) errors.push('Université (min. 3 caractères)');
            if (this.countryOfStudy.trim().length < 2) errors.push("Pays d'études");
            if (this.studyLevel === '') errors.push("Niveau d'études");
            if (this.fieldOfStudy.trim().length < 2) errors.push('Filière (min. 2 caractères)');
        } else if (this.step === 3) {
            if (this.projectStory.trim().length < 50) errors.push('Parcours (min. 50 caractères)');
            if (this.discoverySource === '') errors.push('Source de découverte');
            if (this.isAmbassadorSelected && this.conversationScreenshots.length === 0) {
                errors.push("Captures d'écran requises");
            }
        } else if (this.step === 4) {
            if (this.signatureData === '') errors.push('Signature requise');
        }
        return errors;
    },

    init() {
        this.$nextTick(() => {
            this.initSignatureCanvas();
        });

        const token = localStorage.getItem('auth_token');
        if (token) {
            fetch('/api/user', {
                headers: { 'Authorization': 'Bearer ' + token }
            })
            .then(r => r.json())
            .then(data => {
                if (data.name) {
                    const parts = data.name.split(' ');
                    this.firstName = parts[0] || '';
                    this.lastName = parts.slice(1).join(' ') || '';
                }
                if (data.email) this.email = data.email;
                if (data.phone) this.phone = data.phone;
            })
            .catch(() => {});
        }
    },

    initSignatureCanvas() {
        const canvas = document.getElementById('signature-canvas');
        if (!canvas) return;

        this.signatureCanvas = canvas;
        this.signatureCtx = canvas.getContext('2d', {
            alpha: true,
            desynchronized: true,
            willReadFrequently: false
        });

        const rect = canvas.getBoundingClientRect();
        const dpr = Math.max(window.devicePixelRatio || 1, 4);
        canvas.width = rect.width * dpr;
        canvas.height = rect.height * dpr;
        this.signatureCtx.scale(dpr, dpr);
        this.canvasDpr = dpr;

        this.signatureCtx.strokeStyle = '#0a0a0a';
        this.signatureCtx.fillStyle = '#0a0a0a';
        this.signatureCtx.lineCap = 'round';
        this.signatureCtx.lineJoin = 'round';
        this.signatureCtx.imageSmoothingEnabled = true;
        this.signatureCtx.imageSmoothingQuality = 'high';

        canvas.addEventListener('mousedown', (e) => this.startDrawing(e));
        canvas.addEventListener('mousemove', (e) => this.draw(e));
        canvas.addEventListener('mouseup', () => this.stopDrawing());
        canvas.addEventListener('mouseleave', () => this.stopDrawing());

        canvas.addEventListener('touchstart', (e) => { e.preventDefault(); this.startDrawing(e.touches[0]); }, { passive: false });
        canvas.addEventListener('touchmove', (e) => { e.preventDefault(); this.draw(e.touches[0]); }, { passive: false });
        canvas.addEventListener('touchend', () => this.stopDrawing(), { passive: true });
        canvas.addEventListener('touchcancel', () => this.stopDrawing(), { passive: true });
    },

    getCanvasCoords(e) {
        const rect = this.signatureCanvas.getBoundingClientRect();
        return {
            x: e.clientX - rect.left,
            y: e.clientY - rect.top,
            time: Date.now()
        };
    },

    calculateVelocity(point1, point2) {
        const dx = point2.x - point1.x;
        const dy = point2.y - point1.y;
        const dt = point2.time - point1.time || 1;
        const distance = Math.sqrt(dx * dx + dy * dy);
        return distance / dt;
    },

    getStrokeWidth(velocity) {
        const normalizedVelocity = Math.min(velocity * 2, 1);
        const width = this.maxWidth - (this.maxWidth - this.minWidth) * normalizedVelocity;
        return Math.max(this.minWidth, Math.min(this.maxWidth, width));
    },

    drawCurve(points) {
        if (points.length < 2) return;
        const ctx = this.signatureCtx;

        if (points.length === 2) {
            ctx.beginPath();
            ctx.moveTo(points[0].x, points[0].y);
            ctx.lineTo(points[1].x, points[1].y);
            ctx.lineWidth = points[0].width || this.baseWidth;
            ctx.stroke();
            return;
        }

        for (let i = 1; i < points.length - 1; i++) {
            const p0 = points[i - 1];
            const p1 = points[i];
            const p2 = points[i + 1];

            const midX1 = (p0.x + p1.x) / 2;
            const midY1 = (p0.y + p1.y) / 2;
            const midX2 = (p1.x + p2.x) / 2;
            const midY2 = (p1.y + p2.y) / 2;

            ctx.beginPath();
            ctx.moveTo(midX1, midY1);
            ctx.quadraticCurveTo(p1.x, p1.y, midX2, midY2);

            const avgWidth = (p0.width + p1.width + p2.width) / 3;
            ctx.lineWidth = avgWidth;
            ctx.stroke();
        }
    },

    startDrawing(e) {
        this.isDrawing = true;
        const coords = this.getCanvasCoords(e);

        this.points = [];
        this.lastX = coords.x;
        this.lastY = coords.y;
        this.lastTime = coords.time;
        this.lastVelocity = 0;

        this.points.push({
            x: coords.x,
            y: coords.y,
            time: coords.time,
            width: this.baseWidth
        });

        const ctx = this.signatureCtx;
        ctx.beginPath();
        ctx.arc(coords.x, coords.y, this.baseWidth / 2, 0, Math.PI * 2);
        ctx.fill();
    },

    draw(e) {
        if (!this.isDrawing) return;

        const coords = this.getCanvasCoords(e);

        const dx = coords.x - this.lastX;
        const dy = coords.y - this.lastY;
        const distance = Math.sqrt(dx * dx + dy * dy);

        if (distance < this.minDistance) return;

        const velocity = this.calculateVelocity(
            { x: this.lastX, y: this.lastY, time: this.lastTime },
            coords
        );

        const smoothVelocity = this.velocityFilterWeight * velocity +
                              (1 - this.velocityFilterWeight) * this.lastVelocity;

        const strokeWidth = this.getStrokeWidth(smoothVelocity);

        this.points.push({
            x: coords.x,
            y: coords.y,
            time: coords.time,
            width: strokeWidth
        });

        if (this.points.length >= 3) {
            const recentPoints = this.points.slice(-4);
            this.drawCurve(recentPoints);
        } else if (this.points.length === 2) {
            const ctx = this.signatureCtx;
            ctx.beginPath();
            ctx.moveTo(this.points[0].x, this.points[0].y);
            ctx.lineTo(this.points[1].x, this.points[1].y);
            ctx.lineWidth = (this.points[0].width + this.points[1].width) / 2;
            ctx.stroke();
        }

        this.lastX = coords.x;
        this.lastY = coords.y;
        this.lastTime = coords.time;
        this.lastVelocity = smoothVelocity;
    },

    stopDrawing() {
        if (this.isDrawing) {
            this.isDrawing = false;

            if (this.points.length > 0) {
                const lastPoint = this.points[this.points.length - 1];
                const ctx = this.signatureCtx;
                ctx.beginPath();
                ctx.arc(lastPoint.x, lastPoint.y, lastPoint.width / 3, 0, Math.PI * 2);
                ctx.fill();
            }

            this.signatureData = this.signatureCanvas.toDataURL('image/png', 1.0);
            this.points = [];
        }
    },

    clearSignature() {
        if (this.signatureCtx && this.signatureCanvas) {
            const dpr = this.canvasDpr || Math.max(window.devicePixelRatio || 1, 4);
            this.signatureCtx.clearRect(0, 0, this.signatureCanvas.width / dpr, this.signatureCanvas.height / dpr);
            this.signatureData = '';
            this.points = [];
        }
    },

    nextStep() {
        this.stepValidationAttempted = true;

        let canProceed = false;
        if (this.step === 1) {
            this.firstNameTouched = true;
            this.lastNameTouched = true;
            this.emailTouched = true;
            canProceed = this.isStep1Valid;
        } else if (this.step === 2) {
            this.universityTouched = true;
            this.countryOfStudyTouched = true;
            this.studyLevelTouched = true;
            this.fieldOfStudyTouched = true;
            canProceed = this.isStep2Valid;
        } else if (this.step === 3) {
            this.projectStoryTouched = true;
            this.discoverySourceTouched = true;
            canProceed = this.isStep3Valid;
        } else {
            canProceed = true;
        }

        if (canProceed && this.step < this.totalSteps) {
            this.step++;
            this.stepValidationAttempted = false;
            if (this.step === 4) {
                this.$nextTick(() => this.initSignatureCanvas());
            }
        }
    },

    prevStep() {
        if (this.step > 1) {
            this.step--;
            this.stepValidationAttempted = false;
        }
    },

    handleScreenshotUpload(event) {
        const files = Array.from(event.target.files);
        files.forEach(file => {
            if (file.type.startsWith('image/')) {
                this.compressImage(file).then(compressedFile => {
                    this.conversationScreenshots.push(compressedFile);
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.screenshotPreviews.push(e.target.result);
                    };
                    reader.readAsDataURL(compressedFile);
                });
            }
        });
    },

    compressImage(file, maxWidth = 1200, quality = 0.7) {
        return new Promise((resolve) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    let width = img.width;
                    let height = img.height;

                    if (width > maxWidth) {
                        height = (height * maxWidth) / width;
                        width = maxWidth;
                    }

                    canvas.width = width;
                    canvas.height = height;

                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    canvas.toBlob((blob) => {
                        const compressedFile = new File([blob], file.name, {
                            type: 'image/jpeg',
                            lastModified: Date.now()
                        });
                        resolve(compressedFile);
                    }, 'image/jpeg', quality);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    },

    removeScreenshot(index) {
        this.conversationScreenshots.splice(index, 1);
        this.screenshotPreviews.splice(index, 1);
    },

    async submitForm() {
        this.submitting = true;
        this.error = null;

        const formData = new FormData();
        formData.append('first_name', this.firstName.trim());
        formData.append('last_name', this.lastName.trim());
        formData.append('email', this.email.trim());
        formData.append('phone', this.phone || '');
        formData.append('university', this.university.trim());
        formData.append('country_of_study', this.countryOfStudy.trim());
        formData.append('study_level', this.studyLevel);
        formData.append('field_of_study', this.fieldOfStudy.trim());
        if (this.startYear) formData.append('start_year', this.startYear);
        formData.append('service_used', this.serviceUsed || 'etudes');
        formData.append('project_story', this.projectStory.trim());
        formData.append('discovery_source', this.discoverySource);
        if (this.discoverySourceDetail) formData.append('discovery_source_detail', this.discoverySourceDetail.trim());

        if (this.isAmbassadorSelected) {
            if (this.ambassadorDirectContact !== null) {
                formData.append('ambassador_direct_contact', this.ambassadorDirectContact ? '1' : '0');
            }
            this.conversationScreenshots.forEach((file, index) => {
                formData.append('conversation_screenshots[' + index + ']', file);
            });
        }

        formData.append('rating', this.rating);
        formData.append('rating_accompagnement', this.ratingAccompagnement);
        formData.append('rating_communication', this.ratingCommunication);
        formData.append('rating_delais', this.ratingDelais);
        formData.append('rating_rapport_qualite_prix', this.ratingQualitePrix);
        formData.append('would_recommend', this.wouldRecommend ? '1' : '0');
        formData.append('signature', this.signatureData);

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const authToken = localStorage.getItem('auth_token');

            const headers = {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            };

            if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;
            if (authToken) headers['Authorization'] = 'Bearer ' + authToken;

            const response = await fetch('/api/evaluations', {
                method: 'POST',
                headers: headers,
                body: formData,
                credentials: 'same-origin'
            });

            if (!response.ok) {
                let errorMessage = 'Une erreur est survenue.';

                if (response.status === 413) {
                    errorMessage = 'Les fichiers sont trop volumineux. Réduisez la taille des images.';
                } else if (response.status === 422) {
                    try {
                        const result = await response.json();
                        if (result.errors) {
                            const firstError = Object.values(result.errors)[0];
                            errorMessage = Array.isArray(firstError) ? firstError[0] : firstError;
                        } else if (result.message) {
                            errorMessage = result.message;
                        }
                    } catch (e) {
                        errorMessage = 'Erreur de validation. Vérifiez vos données.';
                    }
                } else if (response.status === 500) {
                    errorMessage = 'Erreur serveur. Veuillez réessayer plus tard.';
                } else {
                    try {
                        const result = await response.json();
                        errorMessage = result.message || 'Erreur ' + response.status;
                    } catch (e) {
                        errorMessage = 'Erreur ' + response.status + ': ' + response.statusText;
                    }
                }

                this.error = errorMessage;
                return;
            }

            const result = await response.json();
            this.success = true;

            // Fermer rapidement après succès (1.5s pour voir le message)
            setTimeout(() => {
                window.dispatchEvent(new CustomEvent('close-evaluation-modal'));
                this.resetForm();
            }, 1500);

        } catch (e) {
            console.error('Erreur lors de la soumission:', e);
            if (e.name === 'TypeError' && e.message.includes('Failed to fetch')) {
                this.error = 'Erreur de connexion. Vérifiez votre connexion internet.';
            } else {
                this.error = 'Erreur inattendue. Veuillez réessayer.';
            }
        } finally {
            this.submitting = false;
        }
    },

    resetForm() {
        this.step = 1;
        this.success = false;
        this.error = null;
        this.firstName = '';
        this.lastName = '';
        this.email = '';
        this.phone = '';
        this.university = '';
        this.countryOfStudy = '';
        this.studyLevel = '';
        this.fieldOfStudy = '';
        this.startYear = '';
        this.serviceUsed = 'etudes';
        this.projectStory = '';
        this.discoverySource = '';
        this.discoverySourceDetail = '';
        this.ambassadorDirectContact = null;
        this.conversationScreenshots = [];
        this.screenshotPreviews = [];
        this.rating = 5;
        this.ratingAccompagnement = 5;
        this.ratingCommunication = 5;
        this.ratingDelais = 5;
        this.ratingQualitePrix = 5;
        this.wouldRecommend = true;
        this.signatureData = '';
        if (this.signatureCanvas) {
            const ctx = this.signatureCanvas.getContext('2d');
            ctx.clearRect(0, 0, this.signatureCanvas.width, this.signatureCanvas.height);
        }
    }
}));

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// ==========================================
// ANIMATIONS & INTERACTIONS PROFESSIONNELLES
// ==========================================

document.addEventListener('DOMContentLoaded', function() {

    // ==========================================
    // MOBILE MENU BURGER
    // ==========================================
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const burgerIcon = mobileMenuButton?.querySelector('.burger-icon');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            // Toggle menu visibility
            mobileMenu.classList.toggle('show');
            mobileMenu.classList.toggle('hidden');

            // Toggle burger icon animation
            burgerIcon.classList.toggle('burger-open');
        });

        // Close menu when clicking on a link
        const mobileLinks = mobileMenu.querySelectorAll('.mobile-menu-link');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.remove('show');
                mobileMenu.classList.add('hidden');
                burgerIcon.classList.remove('burger-open');
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInsideMenu = mobileMenu.contains(event.target);
            const isClickOnButton = mobileMenuButton.contains(event.target);

            if (!isClickInsideMenu && !isClickOnButton && mobileMenu.classList.contains('show')) {
                mobileMenu.classList.remove('show');
                mobileMenu.classList.add('hidden');
                burgerIcon.classList.remove('burger-open');
            }
        });
    }

    // 1. SCROLL REVEAL ANIMATION
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-up');
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observer tous les éléments avec la classe 'reveal'
    document.querySelectorAll('.reveal').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(40px)';
        el.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
        observer.observe(el);
    });

    // 2. PARALLAX EFFECT
    let ticking = false;

    function updateParallax() {
        const scrolled = window.pageYOffset;

        document.querySelectorAll('.parallax-slow').forEach(el => {
            const speed = 0.5;
            el.style.transform = `translateY(${scrolled * speed}px)`;
        });

        document.querySelectorAll('.parallax-fast').forEach(el => {
            const speed = -0.3;
            el.style.transform = `translateY(${scrolled * speed}px)`;
        });

        ticking = false;
    }

    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(updateParallax);
            ticking = true;
        }
    });

    // 3. SMOOTH SCROLL
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));

            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // 4. NAVBAR SCROLL EFFECT
    const navbar = document.querySelector('nav');
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 100) {
            navbar.classList.add('shadow-2xl');
        } else {
            navbar.classList.remove('shadow-2xl');
        }

        // Hide/show navbar on scroll
        if (currentScroll > lastScroll && currentScroll > 500) {
            navbar.style.transform = 'translateY(-100%)';
        } else {
            navbar.style.transform = 'translateY(0)';
        }

        lastScroll = currentScroll;
    });

    navbar.style.transition = 'transform 0.3s ease-in-out';

    // 5. COUNTER ANIMATION
    function animateCounter(element, target, duration = 2000) {
        const start = 0;
        const increment = target / (duration / 16);
        let current = start;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target + '+';
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current) + '+';
            }
        }, 16);
    }

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.animated) {
                const target = parseInt(entry.target.dataset.count);
                animateCounter(entry.target, target);
                entry.target.dataset.animated = 'true';
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('[data-count]').forEach(counter => {
        counterObserver.observe(counter);
    });

    // 6. MAGNETIC BUTTON EFFECT
    document.querySelectorAll('.magnetic-btn').forEach(button => {
        button.addEventListener('mousemove', (e) => {
            const rect = button.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;

            button.style.transform = `translate(${x * 0.2}px, ${y * 0.2}px)`;
        });

        button.addEventListener('mouseleave', () => {
            button.style.transform = 'translate(0, 0)';
        });
    });

    // 7. CARD TILT EFFECT (3D)
    document.querySelectorAll('.tilt-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;

            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.05, 1.05, 1.05)`;
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
        });

        card.style.transition = 'transform 0.3s ease-out';
    });

    // 8. TYPING EFFECT
    function typeWriter(element, text, speed = 50) {
        let i = 0;
        element.textContent = '';

        function type() {
            if (i < text.length) {
                element.textContent += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }

        type();
    }

    // Activer le typing effect sur certains éléments
    const typingObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.typed) {
                const text = entry.target.dataset.typeText || entry.target.textContent;
                typeWriter(entry.target, text);
                entry.target.dataset.typed = 'true';
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.typing-effect').forEach(el => {
        typingObserver.observe(el);
    });

    // 9. IMAGE LAZY LOADING avec effet de blur
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.add('loaded');
                imageObserver.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });

    // 10. SCROLL PROGRESS INDICATOR
    const progressBar = document.createElement('div');
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(90deg, #2B6CB0, #e2a60a);
        z-index: 9999;
        transition: width 0.1s ease-out;
    `;
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', () => {
        const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (window.pageYOffset / windowHeight) * 100;
        progressBar.style.width = scrolled + '%';
    });

    // 11. STAGGER ANIMATION pour les listes
    document.querySelectorAll('.stagger-list').forEach(list => {
        const items = list.children;

        const staggerObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    Array.from(items).forEach((item, index) => {
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0)';
                        }, index * 100);
                    });
                    staggerObserver.unobserve(entry.target);
                }
            });
        });

        Array.from(items).forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });

        staggerObserver.observe(list);
    });

    console.log('✨ Animations professionnelles chargées avec succès!');
});
