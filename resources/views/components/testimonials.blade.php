<!-- Testimonials Section -->
<section class="py-20 bg-gradient-to-br from-slate-50 via-white to-blue-50 relative overflow-hidden" id="testimonials">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-20 left-10 w-72 h-72 bg-primary-200 rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-accent-200 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-display font-extrabold text-dark mb-4 tracking-tight">
                Témoignages
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Découvrez les expériences de nos voyageurs à travers le monde
            </p>
        </div>

        <!-- Testimonials Slider -->
        <div x-data="testimonialSlider()" x-init="init()" class="relative">
            <!-- Loading State -->
            <div x-show="loading" class="text-center py-20">
                <div class="inline-block w-12 h-12 border-4 border-primary-600 border-t-transparent rounded-full animate-spin"></div>
                <p class="mt-4 text-gray-600">Chargement des témoignages...</p>
            </div>

            <!-- Empty State -->
            <div x-show="!loading && testimonials.length === 0" class="text-center py-20">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <p class="text-gray-500 text-lg">Aucun témoignage pour le moment</p>
                <p class="text-gray-400 mt-2">Soyez le premier à partager votre expérience!</p>
            </div>

            <!-- Testimonials Grid/Slider -->
            <div x-show="!loading && testimonials.length > 0" class="relative">
                <!-- Slider Container -->
                <div class="overflow-hidden px-4">
                    <div class="flex transition-transform duration-500 ease-out"
                         :style="`transform: translateX(-${currentIndex * 100}%)`">
                        <template x-for="(testimonial, index) in testimonials" :key="testimonial.id">
                            <div class="w-full flex-shrink-0 px-4">
                                <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 p-8 lg:p-10 max-w-4xl mx-auto border border-gray-100">
                                    <!-- Rating Stars -->
                                    <div class="flex items-center justify-center mb-6">
                                        <template x-for="star in 5" :key="star">
                                            <svg class="w-6 h-6 transition-colors"
                                                 :class="star <= testimonial.rating ? 'text-yellow-400 fill-current' : 'text-gray-300 fill-current'"
                                                 viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </template>
                                    </div>

                                    <!-- Quote Icon -->
                                    <div class="text-center mb-6">
                                        <svg class="w-12 h-12 mx-auto text-primary-200" fill="currentColor" viewBox="0 0 32 32">
                                            <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/>
                                        </svg>
                                    </div>

                                    <!-- Testimonial Content -->
                                    <p class="text-gray-700 text-lg lg:text-xl leading-relaxed text-center italic mb-8"
                                       x-text="testimonial.content"></p>

                                    <!-- Destination Badge -->
                                    <div x-show="testimonial.destination" class="flex justify-center mb-6">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-primary-50 text-primary-700 text-sm font-semibold border border-primary-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span x-text="testimonial.destination"></span>
                                        </span>
                                    </div>

                                    <!-- User Info -->
                                    <div class="flex items-center justify-center border-t border-gray-200 pt-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary-500 to-accent-500 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                                <span x-text="testimonial.user.name.charAt(0).toUpperCase()"></span>
                                            </div>
                                            <div class="text-left">
                                                <p class="font-bold text-dark text-lg" x-text="testimonial.user.name"></p>
                                                <p class="text-sm text-gray-500">
                                                    <span x-text="testimonial.user.position"></span>
                                                    <span x-show="testimonial.user.country"> • </span>
                                                    <span x-text="testimonial.user.country"></span>
                                                </p>
                                                <p class="text-xs text-gray-400 mt-1" x-text="testimonial.created_at"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <div x-show="testimonials.length > 1" class="absolute top-1/2 -translate-y-1/2 left-0 right-0 flex justify-between px-0 lg:-mx-12 pointer-events-none">
                    <button @click="prev()"
                            class="pointer-events-auto w-12 h-12 rounded-full bg-white shadow-xl hover:shadow-2xl flex items-center justify-center text-gray-700 hover:text-primary-600 transition-all hover:scale-110 border border-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button @click="next()"
                            class="pointer-events-auto w-12 h-12 rounded-full bg-white shadow-xl hover:shadow-2xl flex items-center justify-center text-gray-700 hover:text-primary-600 transition-all hover:scale-110 border border-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Dots Navigation -->
                <div x-show="testimonials.length > 1" class="flex justify-center space-x-3 mt-8">
                    <template x-for="(testimonial, index) in testimonials" :key="index">
                        <button @click="goTo(index)"
                                class="w-3 h-3 rounded-full transition-all duration-300"
                                :class="currentIndex === index ? 'bg-primary-600 w-8' : 'bg-gray-300 hover:bg-gray-400'"></button>
                    </template>
                </div>
            </div>
        </div>

        <!-- CTA Button -->
        <div class="text-center mt-16">
            <button @click="openTestimonialModal()"
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-primary-600 via-primary-700 to-accent-600 text-white text-lg font-bold rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 space-x-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span>Déposer mon témoignage</span>
            </button>
        </div>
    </div>

    <!-- Testimonial Modal -->
    <div x-data="testimonialModal()" x-show="showModal"
         x-cloak
         @open-testimonial-modal.window="open()"
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"
             @click="close()"></div>

        <!-- Modal Content -->
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full p-8"
                 @click.away="close()"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95">

                <!-- Close Button -->
                <button @click="close()"
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <h3 class="text-3xl font-bold text-dark mb-6">Partagez votre expérience</h3>

                <!-- Alert Container -->
                <div id="modal-alert" class="mb-6"></div>

                <form @submit.prevent="submitTestimonial()" id="testimonialForm">
                    <!-- Rating -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-dark mb-3">Votre note</label>
                        <div class="flex space-x-2">
                            <template x-for="star in 5" :key="star">
                                <button type="button" @click="rating = star"
                                        class="focus:outline-none transition-transform hover:scale-110">
                                    <svg class="w-10 h-10"
                                         :class="star <= rating ? 'text-yellow-400 fill-current' : 'text-gray-300 fill-current'"
                                         viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Destination -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-dark mb-2">Destination (optionnel)</label>
                        <input type="text" x-model="destination"
                               placeholder="Paris, Tokyo, New York..."
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all">
                    </div>

                    <!-- Content -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-dark mb-2">Votre témoignage</label>
                        <textarea x-model="content"
                                  rows="5"
                                  placeholder="Partagez votre expérience de voyage... (minimum 20 caractères)"
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all resize-none"></textarea>
                        <p class="text-sm text-gray-500 mt-2">
                            <span x-text="content.length"></span> / 500 caractères
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" :disabled="submitting"
                            class="w-full py-4 bg-gradient-to-r from-primary-600 via-primary-700 to-accent-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                        <span x-show="!submitting">Envoyer mon témoignage</span>
                        <span x-show="submitting">Envoi en cours...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    [x-cloak] { display: none !important; }

    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        25% { transform: translate(20px, -50px) scale(1.1); }
        50% { transform: translate(-20px, 20px) scale(0.9); }
        75% { transform: translate(50px, 50px) scale(1.05); }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }
</style>

<script>
    function testimonialSlider() {
        return {
            testimonials: [],
            currentIndex: 0,
            loading: true,
            autoplayInterval: null,

            init() {
                this.fetchTestimonials();
                this.startAutoplay();
            },

            async fetchTestimonials() {
                try {
                    const response = await fetch('/api/testimonials');
                    const data = await response.json();

                    if (data.success) {
                        this.testimonials = data.data;
                    }
                } catch (error) {
                    console.error('Error fetching testimonials:', error);
                } finally {
                    this.loading = false;
                }
            },

            next() {
                if (this.currentIndex < this.testimonials.length - 1) {
                    this.currentIndex++;
                } else {
                    this.currentIndex = 0;
                }
                this.resetAutoplay();
            },

            prev() {
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                } else {
                    this.currentIndex = this.testimonials.length - 1;
                }
                this.resetAutoplay();
            },

            goTo(index) {
                this.currentIndex = index;
                this.resetAutoplay();
            },

            startAutoplay() {
                this.autoplayInterval = setInterval(() => {
                    if (this.testimonials.length > 1) {
                        this.next();
                    }
                }, 5000);
            },

            resetAutoplay() {
                clearInterval(this.autoplayInterval);
                this.startAutoplay();
            }
        }
    }

    function testimonialModal() {
        return {
            showModal: false,
            rating: 5,
            destination: '',
            content: '',
            submitting: false,

            open() {
                this.showModal = true;
                document.body.style.overflow = 'hidden';
            },

            close() {
                this.showModal = false;
                document.body.style.overflow = 'auto';
                this.reset();
            },

            reset() {
                this.rating = 5;
                this.destination = '';
                this.content = '';
                this.submitting = false;
                document.getElementById('modal-alert').innerHTML = '';
            },

            async submitTestimonial() {
                const alertContainer = document.getElementById('modal-alert');
                alertContainer.innerHTML = '';

                // Check if user is logged in
                const token = localStorage.getItem('auth_token');
                if (!token) {
                    alertContainer.innerHTML = `
                        <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-4 flex items-center space-x-3">
                            <svg class="w-6 h-6 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <p class="text-yellow-800 text-sm font-medium">Vous devez être connecté pour déposer un témoignage. <a href="/login" class="underline font-bold">Se connecter</a></p>
                        </div>
                    `;
                    return;
                }

                // Validation
                if (this.content.length < 20) {
                    alertContainer.innerHTML = `
                        <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4 flex items-center space-x-3">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-red-800 text-sm font-bold">Le témoignage doit contenir au moins 20 caractères.</p>
                        </div>
                    `;
                    return;
                }

                this.submitting = true;

                try {
                    const response = await fetch('/api/testimonials', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${token}`
                        },
                        body: JSON.stringify({
                            content: this.content,
                            destination: this.destination,
                            rating: this.rating
                        })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        alertContainer.innerHTML = `
                            <div class="bg-green-50 border-2 border-green-200 rounded-xl p-4 flex items-center space-x-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-green-800 text-sm font-bold">${data.message}</p>
                            </div>
                        `;

                        setTimeout(() => {
                            this.close();
                        }, 2000);
                    } else {
                        const errorMessage = data.errors ? Object.values(data.errors)[0][0] : data.message;
                        alertContainer.innerHTML = `
                            <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4 flex items-center space-x-3">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-red-800 text-sm font-bold">${errorMessage}</p>
                            </div>
                        `;
                    }
                } catch (error) {
                    alertContainer.innerHTML = `
                        <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4 flex items-center space-x-3">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-red-800 text-sm font-bold">Erreur de connexion au serveur</p>
                        </div>
                    `;
                } finally {
                    this.submitting = false;
                }
            }
        }
    }

    function openTestimonialModal() {
        window.dispatchEvent(new CustomEvent('open-testimonial-modal'));
    }
</script>
