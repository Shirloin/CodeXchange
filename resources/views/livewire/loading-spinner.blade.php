<div wire:loading class="fixed top-0 left-0 w-screen h-screen justify-center items-center bg-black bg-opacity-80 z-50 "
    id="loadingOverlay">
    <div class="text-white text-lg"><span class="loader"></span></div>
</div>
<style>
    .loader {
        width: 48px;
        height: 48px;
        border: 5px solid #FFF;
        border-bottom-color: transparent;
        border-radius: 50%;
        display: inline-block;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
    }

    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
