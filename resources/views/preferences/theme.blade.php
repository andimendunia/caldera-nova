<x-app-layout>
    <x-slot name="title">
        <title>{{__('Tema')}}</title>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-neutral-800 dark:text-neutral-200 leading-tight">
            <x-link href="{{ route('preferences') }}" class="inline-block py-6"><i class="fa fa-arrow-left"></i></x-link><span class="ml-4">{{ __('Tema') }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-3 sm:px-6 lg:px-8 space-y-6 text-sm text-neutral-900 dark:text-neutral-100">
            <fieldset class="grid grid-cols-2 gap-2 sm:grid-cols-3 sm:gap-4">            
                <div>
                  <input type="radio" name="theme" id="theme-auto" class="peer hidden [&:checked_+_label_svg]:block" checked />
                  <label for="theme-auto" class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 shadow-sm hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                    <div class="flex items-center justify-between text-2xl">
                        <p><i class="text-neutral-500 fa fa-circle-half-stroke"></i></p>
                        <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="mt-1">{{ __('Patuhi tema sistem')}}</p>
                  </label>
                </div>              
                <div>
                  <input type="radio" name="theme" id="theme-light" class="peer hidden [&:checked_+_label_svg]:block" />
                  <label for="theme-light" class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 shadow-sm hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                    <div class="flex items-center justify-between text-2xl">
                      <p><i class="text-neutral-500 fa fa-sun"></i></p>
                      <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" >
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                      </svg>
                    </div> 
                    <p class="mt-1">{{ __('Cerah') }}</p>
                  </label>
                </div>
                <div>
                    <input type="radio" name="theme" id="theme-dark" class="peer hidden [&:checked_+_label_svg]:block" />
                    <label for="theme-dark" class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 shadow-sm hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-caldy-500 peer-checked:ring-1 peer-checked:ring-caldy-500">
                      <div class="flex items-center justify-between text-2xl">
                        <p><i class="text-neutral-500 fa fa-moon"></i></p>
                        <svg class="hidden h-6 w-6 text-caldy-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" >
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                      </div> 
                      <p class="mt-1">{{ __('Gelap') }}</p>
                    </label>
                  </div>
            </fieldset>
            <fieldset class="grid grid-cols-2 gap-2 sm:grid-cols-3 sm:gap-4">            
                <div>
                  <input type="radio" name="theme" id="theme-pink" class="peer hidden [&:checked_+_label_svg]:block" checked />
                  <label for="theme-pink" class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 shadow-sm hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-pink-500 peer-checked:ring-1 peer-checked:ring-pink-500">
                    <div class="flex items-center justify-between text-2xl">
                        <div class="flex gap-1"><i class="text-pink-500 fa fa-square"></i></div>
                        <svg class="hidden h-6 w-6 text-pink-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="mt-1">{{ __('Pink kasmaran')}}</p>
                  </label>
                </div>              
                <div>
                    <input type="radio" name="theme" id="theme-blue" class="peer hidden [&:checked_+_label_svg]:block" checked />
                    <label for="theme-blue" class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 shadow-sm hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-blue-500 peer-checked:ring-1 peer-checked:ring-blue-500">
                      <div class="flex items-center justify-between text-2xl">
                          <div class="flex gap-1"><i class="text-blue-500 fa fa-square"></i></div>
                          <svg class="hidden h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                          </svg>
                      </div>
                      <p class="mt-1">{{ __('Biru cakrawala')}}</p>
                    </label>
                </div> 
                <div>
                    <input type="radio" name="theme" id="theme-orange" class="peer hidden [&:checked_+_label_svg]:block" checked />
                    <label for="theme-orange" class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 shadow-sm hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-amber-500 peer-checked:ring-1 peer-checked:ring-amber-500">
                      <div class="flex items-center justify-between text-2xl">
                          <div class="flex gap-1"><i class="text-amber-500 fa fa-square"></i></div>
                          <svg class="hidden h-6 w-6 text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                          </svg>
                      </div>
                      <p class="mt-1">{{ __('Jingga lembayung')}}</p>
                    </label>
                </div> 
                <div>
                    <input type="radio" name="theme" id="theme-teal" class="peer hidden [&:checked_+_label_svg]:block" checked />
                    <label for="theme-teal" class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 shadow-sm hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-teal-500 peer-checked:ring-1 peer-checked:ring-teal-500">
                      <div class="flex items-center justify-between text-2xl">
                          <div class="flex gap-1"><i class="text-teal-500 fa fa-square"></i></div>
                          <svg class="hidden h-6 w-6 text-teal-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                          </svg>
                      </div>
                      <p class="mt-1">{{ __('Hijau memukau')}}</p>
                    </label>
                </div> 
                <div>
                    <input type="radio" name="theme" id="theme-green" class="peer hidden [&:checked_+_label_svg]:block" checked />
                    <label for="theme-green" class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 shadow-sm hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-green-500 peer-checked:ring-1 peer-checked:ring-green-500">
                      <div class="flex items-center justify-between text-2xl">
                          <div class="flex gap-1"><i class="text-green-500 fa fa-square"></i></div>
                          <svg class="hidden h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                          </svg>
                      </div>
                      <p class="mt-1">{{ __('Hijau rumput tetangga')}}</p>
                    </label>
                </div> 
                <div>
                    <input type="radio" name="theme" id="theme-gray" class="peer hidden [&:checked_+_label_svg]:block" checked />
                    <label for="theme-gray" class="block h-full cursor-pointer rounded-lg border border-neutral-200 dark:border-neutral-800 p-4 shadow-sm hover:border-neutral-300 dark:hover:border-neutral-700 peer-checked:border-gray-500 peer-checked:ring-1 peer-checked:ring-gray-500">
                      <div class="flex items-center justify-between text-2xl">
                          <div class="flex gap-1"><i class="text-gray-500 fa fa-square"></i></div>
                          <svg class="hidden h-6 w-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                          </svg>
                      </div>
                      <p class="mt-1">{{ __('Abu hilang asa')}}</p>
                    </label>
                </div> 
            </fieldset>
        </div>
    </div>
</x-app-layout>