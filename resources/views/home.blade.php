<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4 lg:px-8">
        <div class="container relative max-w-2xl mx-auto text-center tracking-widest text-neutral-500 ">
            <div class="card-container w-full my-auto">
              <div class="card relative h-40">
                <div class="front w-full h-full">
                    <div class="p-5 text-xl sm:text-3xl">
                        {{ $greeting }}
                    </div>
                </div>
                <div class="back w-full h-full">
                    <div class="p-5 text-3xl sm:text-5xl">
                        Caldera
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div class="text-neutral-500">
            <div class="text-center mb-20">
                <div class="mb-2">{{ __('Waktu server:').' '.$time}}</div>
                <div>{{ __('5 pengguna daring')}}</div>   
            </div>
            <div class="flex flex-wrap justify-center gap-3">
                <div class="inline-block bg-white dark:bg-neutral-800 rounded-full p-2">
                    <div class="flex w-28 h-full truncate items-center gap-2">
                        <div>
                            <div class="w-6 h-6 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                            </div>
                        </div>
                        <div class="truncate">Jelsi Berlianne</div>
                    </div>
                </div>
                <div class="inline-block bg-white dark:bg-neutral-800 rounded-full p-2">
                    <div class="flex w-28 h-full truncate items-center gap-2">
                        <div>
                            <div class="w-6 h-6 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                            </div>
                        </div>
                        <div class="truncate">Taylor Swift</div>
                    </div>
                </div>
                <div class="inline-block bg-white dark:bg-neutral-800 rounded-full p-2">
                    <div class="flex w-28 h-full truncate items-center gap-2">
                        <div>
                            <div class="w-6 h-6 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                            </div>
                        </div>
                        <div class="truncate">Lana Del Rey</div>
                    </div>
                </div>
                <div class="inline-block bg-white dark:bg-neutral-800 rounded-full p-2">
                    <div class="flex w-28 h-full truncate items-center gap-2">
                        <div>
                            <div class="w-6 h-6 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                            </div>
                        </div>
                        <div class="truncate">Billie Eilish</div>
                    </div>
                </div>
                <div class="inline-block bg-white dark:bg-neutral-800 rounded-full p-2">
                    <div class="flex w-28 h-full truncate items-center gap-2">
                        <div>
                            <div class="w-6 h-6 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                            </div>
                        </div>
                        <div class="truncate">Nicki Minaj</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* entire container, keeps perspective */
        .card-container {
            -webkit-perspective: 1000px;
            perspective: 1000px;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
        }

        /* flip class added with javascript on click */
        .card-container .front {
            /* For IE10 you have to animate each face separately. */
            /* Isnt great on low end devices because */
            /* they can animate at different times */
            /* IE9 does not support CSS animations */
            -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
        }
        .card-container .back {
            -webkit-transform: rotateX(180deg);
            transform: rotateX(180deg);
        }

        .card .front,
        .card .back {
            position: absolute;
            top: 0;
            left: 0;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-transition: transform 1s ease;
            transition: transform 1s ease;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
        }

        @keyframes expand{
            from{
                letter-spacing: 0;
            }
            to{
                letter-spacing: 6pt;
            }
        }

        .front > div {
            animation-name: expand;
            animation-duration: 5s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }

        @keyframes flipfront{
            from{
                -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
            }
            to{
                -webkit-transform: rotateX(180deg);
                transform: rotateX(180deg);
            }
        }

        @keyframes flipback{
            from{
                -webkit-transform: rotateX(-180deg);
                transform: rotateX(-180deg);
            }
            to{
                -webkit-transform: rotateX(0deg);
                transform: rotateX(0deg);
            }
        }

        .card .front {
            /* z-index so front card stays above back */
            z-index: 2;
            animation-name: flipfront;
            animation-duration: 1s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
            animation-delay: 1s;

        }

        .card .back {
            /* back, initially hidden */
            animation-name: flipback;
            animation-duration: 1s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
            animation-delay: 1s;

        }
    </style>
</x-app-layout>
