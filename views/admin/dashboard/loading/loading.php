<link rel="stylesheet" href="../../../../css/index.css">
<style>
    .loading-container {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .loading-container .loading-img img {
        animation: load 2s ease-in-out infinite;
    }

    @keyframes load {
        0% {
            opacity: 0;
        }
        50% {
            opacity: 50%;
        }
        100% {
            opacity: 100%;
        }
    }
</style>
<body>
    <div class="loading-container">
        <div class="loading-img">
            <img src="/redspartan_logo.png" alt="redSpartan">
        </div>
    </div>
</body>
