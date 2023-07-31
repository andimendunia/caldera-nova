<x-app-layout>
    <div class="max-w-7xl mx-auto mt-8 px-4 lg:px-8">
        <div class="container relative max-w-2xl mx-auto text-center tracking-widest text-gray-500 ">
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
