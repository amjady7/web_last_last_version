@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<style>
    /* Mission & Vision Styles */
    .mission-vision-container {
        display: flex;
        flex-direction: column;
        gap: 8rem;
    }

    @media (min-width: 768px) {
        .mission-vision-container {
            flex-direction: row;
            justify-content: space-between;
            gap: 6rem;
        }

        .mission-vision-card {
            flex: 0 0 calc(50% - 3rem);
            margin: 2rem 0;
        }
    }

    /* Company Overview Styles */
    .company-overview-container {
        display: flex;
        flex-direction: column;
        gap: 8rem;
    }

    @media (min-width: 768px) {
        .company-overview-container {
            flex-direction: row;
            align-items: center;
            gap: 6rem;
        }

        .company-overview-content {
            flex: 0 0 calc(50% - 3rem);
            margin: 2rem 0;
        }

        .company-overview-image {
            flex: 0 0 calc(50% - 3rem);
            margin: 2rem 0;
        }
    }

    /* Core Values Styles */
    .core-values-container {
        display: flex;
        flex-direction: column;
        gap: 6rem;
    }

    @media (min-width: 768px) {
        .core-values-container {
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 4rem;
        }

        .core-value-card {
            flex: 0 0 calc(33.333% - 3rem);
            margin: 2rem 0;
        }
    }

    /* Team Section Styles */
    .team-container {
        display: flex;
        flex-direction: column;
        gap: 6rem;
    }

    @media (min-width: 768px) {
        .team-container {
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 4rem;
        }

        .team-member {
            flex: 0 0 calc(33.333% - 3rem);
            margin: 2rem 0;
        }
    }

    /* Call to Action Styles */
    .cta-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align:center;
        gap: 6rem;
    }

    .cta-buttons {
        display: flex;
        gap: 3rem;
        flex-wrap: wrap;
        justify-content: center;
        margin: 2rem 0;
    }

    /* General Card Styles */
    .mission-vision-card,
    .core-value-card,
    .team-member {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .mission-vision-card:hover,
    .core-value-card:hover,
    .team-member:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="bg-white">
    <!-- Hero Section -->
    <div class="relative bg-orange-50 py-96">
        <div class="container mx-auto px-32">
            <div class="text-center">
                <h1 class="text-5xl font-bold text-gray-900 mb-32">Welcome to Our Story</h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    We're more than just an e-commerce platform - we're a community dedicated to bringing you the best products and experiences.
                </p>
            </div>
        </div>
    </div>

    <!-- Company Overview -->
    <div class="py-96 my-64">
        <div class="container mx-auto px-32">
            <div class="company-overview-container">
                <div class="company-overview-content text-center max-w-4xl mx-auto">
                    <h2 class="text-4xl font-bold text-gray-900 mb-32">Our Journey</h2>
                    <p class="text-gray-600 mb-24 text-lg">
                        Since our inception in 2024, we've been on a mission to revolutionize online shopping. 
                        What started as a small team with a big dream has grown into a thriving e-commerce platform 
                        serving customers across the globe.
                    </p>
                    <p class="text-gray-600 text-lg">
                        Our success is built on three pillars: exceptional quality, unbeatable prices, and 
                        customer service that goes above and beyond. We're not just selling products - we're 
                        creating experiences that our customers love.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="bg-gray-50 py-96 my-64">
        <div class="container mx-auto px-32">
            <div class="mission-vision-container">
                <div class="mission-vision-card bg-white p-32 rounded-xl shadow-lg max-w-2xl mx-auto">
                    <h2 class="text-3xl font-bold text-gray-900 mb-32 text-center">Our Mission</h2>
                    <p class="text-gray-600 text-lg mb-24 text-center">
                        To transform the online shopping experience by providing:
                    </p>
                    <ul class="list-disc list-inside text-gray-600 space-y-16 text-lg">
                        <li>Premium quality products at competitive prices</li>
                        <li>Seamless shopping experience from start to finish</li>
                        <li>Outstanding customer service that exceeds expectations</li>
                        <li>Innovative solutions to everyday shopping needs</li>
                    </ul>
                </div>
                <div class="mission-vision-card bg-white p-32 rounded-xl shadow-lg max-w-2xl mx-auto">
                    <h2 class="text-3xl font-bold text-gray-900 mb-32 text-center">Our Vision</h2>
                    <p class="text-gray-600 text-lg mb-24 text-center">
                        We envision a future where:
                    </p>
                    <ul class="list-disc list-inside text-gray-600 space-y-16 text-lg">
                        <li>Every customer feels valued and understood</li>
                        <li>Shopping is not just a transaction, but an experience</li>
                        <li>Quality and affordability go hand in hand</li>
                        <li>Innovation drives continuous improvement</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Values -->
    <div class="py-96 my-64">
        <div class="container mx-auto px-32">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-96">Our Core Values</h2>
            <div class="core-values-container mt-48">
                <div class="core-value-card bg-white p-32 rounded-xl shadow-lg hover:shadow-xl transition duration-300 max-w-sm mx-auto">
                    <div class="text-orange-400 text-5xl mb-32 text-center">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-24 text-center text-gray-900">Quality First</h3>
                    <p class="text-gray-600 text-lg text-center">
                        We never compromise on quality. Every product in our catalog undergoes rigorous 
                        testing to ensure it meets our high standards.
                    </p>
                </div>
                <div class="core-value-card bg-white p-32 rounded-xl shadow-lg hover:shadow-xl transition duration-300 max-w-sm mx-auto">
                    <div class="text-orange-400 text-5xl mb-32 text-center">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-24 text-center text-gray-900">Customer Centric</h3>
                    <p class="text-gray-600 text-lg text-center">
                        Our customers are our priority. We listen, we learn, and we continuously improve 
                        to meet their needs and exceed their expectations.
                    </p>
                </div>
                <div class="core-value-card bg-white p-32 rounded-xl shadow-lg hover:shadow-xl transition duration-300 max-w-sm mx-auto">
                    <div class="text-orange-400 text-5xl mb-32 text-center">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-24 text-center text-gray-900">Innovation</h3>
                    <p class="text-gray-600 text-lg text-center">
                        We embrace change and innovation, constantly seeking new ways to enhance our 
                        services and improve the shopping experience.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="bg-gray-50 py-96 my-64">
        <div class="container mx-auto px-32">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-96">Meet Our Leadership Team</h2>
            <div class="team-container mt-48">
                <div class="team-member text-center max-w-sm mx-auto">
                    <div class="w-96 h-96 mx-auto mb-32 rounded-full overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a" 
                             alt="Team Member" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-2xl font-semibold mb-24 text-gray-900">John Doe</h3>
                    <p class="text-gray-600 mb-24">Founder & CEO</p>
                    <p class="text-gray-600 text-lg">
                        Visionary leader with 15+ years of experience in e-commerce and digital innovation.
                    </p>
                </div>
                <div class="team-member text-center max-w-sm mx-auto">
                    <div class="w-96 h-96 mx-auto mb-32 rounded-full overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2" 
                             alt="Team Member" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-2xl font-semibold mb-24 text-gray-900">Jane Smith</h3>
                    <p class="text-gray-600 mb-24">Marketing Director</p>
                    <p class="text-gray-600 text-lg">
                        Expert in digital marketing and brand strategy with a passion for customer engagement.
                    </p>
                </div>
                <div class="team-member text-center max-w-sm mx-auto">
                    <div class="w-96 h-96 mx-auto mb-32 rounded-full overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d" 
                             alt="Team Member" 
                             class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-2xl font-semibold mb-24 text-gray-900">Mike Johnson</h3>
                    <p class="text-gray-600 mb-24">Operations Manager</p>
                    <p class="text-gray-600 text-lg">
                        Operations specialist focused on efficiency and quality control.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    
</div>
@endsection 