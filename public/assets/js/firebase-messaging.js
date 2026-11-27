
// Firebase Configuration
const firebaseConfig = {
    apiKey: "AIzaSyCyMoLV_ZxhoG27JluKa8Wv4R061JQnJVQ",
    authDomain: "inventory-management-sys-b9337.firebaseapp.com",
    projectId: "inventory-management-sys-b9337",
    storageBucket: "inventory-management-sys-b9337.firebasestorage.app",
    messagingSenderId: "514584525632",
    appId: "1:514584525632:web:d11952683108f0f73dd8a5",
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

// Register Firebase Service Worker
async function registerFirebaseNotifications() {

    try {

        if (!('serviceWorker' in navigator)) {
            console.log('Service Worker not supported');
            return;
        }

        if (!('Notification' in window)) {
            console.log('Notifications not supported');
            return;
        }

        const permission = await Notification.requestPermission();

        if (permission !== 'granted') {
            console.log('Notification permission not granted');
            return;
        }

        const registration = await navigator.serviceWorker.register(
            '/firebase-messaging-sw.js'
        );

        // Generate FCM Token
        const token = await messaging.getToken({
            vapidKey: 'YOUR_VAPID_PUBLIC_KEY',
            serviceWorkerRegistration: registration
        });

        if (!token) {
            console.log('FCM token not generated');
            return;
        }

        console.log('FCM Token:', token);

        // Save token in Laravel database
        const response = await fetch('/save-device-token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                fcm_token: token,
                device_type: 'android'
            })
        });

        const result = await response.json();

        console.log('Token save response:', result);

    } catch (error) {

        console.error('Firebase notification error:', error);

    }
}

// Listen for foreground notifications
messaging.onMessage(function(payload) {

    console.log('Foreground notification:', payload);

    if (Notification.permission === 'granted') {

        new Notification(
            payload.notification?.title || 'Inventory Notification',
            {
                body: payload.notification?.body || 'You have a new notification',
                icon: '/favicon.ico'
            }
        );

    }
});


document.getElementById('enableNotifications')
    ?.addEventListener('click', function () {
        registerFirebaseNotifications();
    });