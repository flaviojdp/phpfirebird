let cacheName = 'v01001';
let filesToCache = [
    './',
    './index.html',
    '../js/angular/angular.min.js',
    '../js/angular/angular.min.js.map',
];

self.addEventListener('install',function(e){
    console.log('[ServiceWorker] Installer');
    e.waitUntil(
        caches.open( cacheName ).then(function(cache){
            console.log('[ServiceWorker] Caching app shell');
            return cache.addAll( filesToCache );
        })
    );
});

self.addEventListener('active',function(e){
    console.log('[ServiceWorker] Activate');
    e.waitUntil(
        caches.keys().then(function(KeyList){
            return Promise.all(KeyList.map(function(key){
                if( key !== cacheName ){
                    return caches.delete(key);
                }
            }));
        })
    );
});

self.addEventListener('fetch',function(e){
    console.log("cache");
    e.respondWith(
        caches.match( e.request ).then(function(response){
            return response || fetch(e.request);
        })
    );
});