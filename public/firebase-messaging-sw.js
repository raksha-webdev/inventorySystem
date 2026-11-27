
importScripts('https://www.gstatic.com/firebasejs/10.13.0/firebase-app-compat.js');

importScripts('https://www.gstatic.com/firebasejs/10.13.0/firebase-messaging-compat.js');

firebase.initializeApp({
    apiKey: "AIzaSyCyMoLV_ZxhoG27JluKa8Wv4R061JQnJVQ",
    authDomain: "inventory-management-sys-b9337.firebaseapp.com",
    projectId: "inventory-management-sys-b9337",
    storageBucket: "inventory-management-sys-b9337.firebasestorage.app",
    messagingSenderId: "514584525632",
    appId: "1:514584525632:web:d11952683108f0f73dd8a5",
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {

    const title = payload.notification?.title || 'Inventory Notification';

    const options = {
        body: payload.notification?.body || 'You have a new notification',
        icon: '/favicon.ico'
    };

    self.registration.showNotification(title, options);
});
