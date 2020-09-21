if ('serviceWorker' in navigator) {
  console.log('Service Worker is supported');
  
  navigator.serviceWorker.register('/service-worker.js')
  .then(function(registration) {
    console.log('Registration successful, scope is:', registration.scope);
  })
  .catch(function(error) {
    console.log('Service worker registration failed, error:', error);
  });
}else{
  console.warn('Push messaging is not supported');
//   pushButton.textContent = 'Push Not Supported';
}