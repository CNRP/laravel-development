<?php
use App\Models\Service;
$services = App\Models\Service::all();

?>
<x-guest-layout>

    <div class="py-6">
        <div class="max-w-7xl flex mx-auto gap-8 sm:px-6 lg:px-8">
            <div class="bg-white w-1200 px-8 py-8 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="max-w-lg mx-auto">
                    <h2 class="text-2xl font-bold mb-4">Privacy Statement</h2>
                    <p class="text-gray-700 mb-6">
                        At BarberShop, we take your privacy seriously. This privacy statement outlines how we collect, use, and protect the personal information you provide to us when registering or logging in through Facebook.
                    </p>
                    <h3 class="text-lg font-bold mb-2">Collection of Personal Information</h3>
                    <p class="text-gray-700 mb-6">
                        When you register on our website or log in through Facebook, we may collect the following personal information:
                    </p>
                    <ul class="list-disc list-inside mb-6">
                        <li class="text-gray-700">Name: We require your name to personalize your experience and address you correctly.</li>
                        <li class="text-gray-700">Email: We collect your email address to communicate with you, send important updates, and verify your account.</li>
                        <li class="text-gray-700">Phone Number: We may request your phone number to provide additional security measures and facilitate communication if necessary.</li>
                    </ul>
                    <h3 class="text-lg font-bold mb-2">Use of Personal Information</h3>
                    <p class="text-gray-700 mb-6">
                        We use the collected personal information for the following purposes:
                    </p>
                    <ul class="list-disc list-inside mb-6">
                        <li class="text-gray-700">Account Creation: We use your name, email address, and phone number (if provided) to create and manage your user account on our website.</li>
                        <li class="text-gray-700">Communication: We may use your email address or phone number to send you important updates, notifications, and respond to your inquiries.</li>
                        <li class="text-gray-700">Personalization: Your name and email address may be used to personalize your experience on our website, such as displaying your name when you log in.</li>
                        <li class="text-gray-700">Security: Your information, including your email address and phone number (if provided), may be used to protect your account and prevent unauthorized access.</li>
                    </ul>
                    <h3 class="text-lg font-bold mb-2">Storage and Security of Personal Information</h3>
                    <p class="text-gray-700 mb-6">
                        We take reasonable measures to ensure the security and confidentiality of your personal information. Your data is stored securely in our systems and is only accessible to authorized personnel who require access to perform their duties. We follow industry best practices to protect your information against loss, theft, unauthorized access, disclosure, or alteration.
                    </p>
                    <h3 class="text-lg font-bold mb-2">Third-Party Disclosure</h3>
                    <p class="text-gray-700 mb-6">
                        We do not sell, trade, or transfer your personal information to third parties without your consent, except for the necessary purposes outlined in this privacy statement. However, please note that if you choose to log in through Facebook, certain information from your Facebook profile, as allowed by Facebook's privacy settings, may be accessed and stored by us.
                    </p>
                    <h3 class="text-lg font-bold mb-2">Data Retention</h3>
                    <p class="text-gray-700 mb-6">
                        We will retain your personal information for as long as necessary to fulfill the purposes outlined in this privacy statement or as required by law. When your information is no longer required, we will securely delete or anonymize it.
                    </p>
                    <h3 class="text-lg font-bold mb-2">Your Rights</h3>
                    <p class="text-gray-700 mb-6">
                        You have the right to access, update, correct, or delete your personal information stored on our website. If you would like to exercise any of these rights or have any concerns regarding your privacy, please contact us using the information provided below.
                    </p>
                    <h3 class="text-lg font-bold mb-2">Changes to the Privacy Statement</h3>
                    <p class="text-gray-700 mb-6">
                        We reserve the right to update or modify this privacy statement at any time. Any changes made will be effective immediately upon posting the updated version on our website. We encourage you to review this privacy statement periodically to stay informed about how we handle and protect your personal information.
                    </p>
                    <h3 class="text-lg font-bold mb-2">Contact Us</h3>
                    <p class="text-gray-700 mb-6">
                        If you have any questions, concerns, or requests regarding this privacy statement or the way we handle your personal information, please contact us at:
                    </p>
                    <p class="text-gray-700">
                        help@connorprice.info
                    </p>
                </div>


            </div>
        </div>
    </div>

</x-guest-layout>
