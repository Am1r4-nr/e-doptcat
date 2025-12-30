<x-app-layout>
    <div class="py-12 bg-boho-bg min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="font-serif font-bold text-4xl text-boho-brown mb-4">
                    {{ __('Our Cats') }}
                </h2>
                <div class="w-24 h-1 bg-boho-orange mx-auto rounded-full"></div>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                    Browse our lovely cats waiting for a forever home. Filter by breed to find your perfect companion.
                </p>
            </div>

            <!-- Filter -->
            <div class="mb-10 flex justify-center">
                <form method="GET" action="{{ route('cats.index') }}" class="flex flex-col sm:flex-row gap-4 bg-white p-2 rounded-2xl shadow-sm border border-boho-light">
                    <div class="relative">
                        <select name="breed" class="appearance-none bg-boho-light border-0 text-gray-700 py-3 px-6 pr-10 rounded-xl focus:ring-2 focus:ring-boho-brown focus:bg-white transition-colors cursor-pointer min-w-[200px]">
                            <option value="">All Breeds</option>
                            <option value="Siamese" {{ request('breed') == 'Siamese' ? 'selected' : '' }}>Siamese</option>
                            <option value="Persian" {{ request('breed') == 'Persian' ? 'selected' : '' }}>Persian</option>
                            <option value="Bengal" {{ request('breed') == 'Bengal' ? 'selected' : '' }}>Bengal</option>
                            <option value="Maine Coon" {{ request('breed') == 'Maine Coon' ? 'selected' : '' }}>Maine Coon</option>
                            <option value="Ragdoll" {{ request('breed') == 'Ragdoll' ? 'selected' : '' }}>Ragdoll</option>
                            <option value="Sphynx" {{ request('breed') == 'Sphynx' ? 'selected' : '' }}>Sphynx</option>
                            <option value="British Shorthair" {{ request('breed') == 'British Shorthair' ? 'selected' : '' }}>British Shorthair</option>
                            <option value="Devon Rex" {{ request('breed') == 'Devon Rex' ? 'selected' : '' }}>Devon Rex</option>
                            <option value="Siberian" {{ request('breed') == 'Siberian' ? 'selected' : '' }}>Siberian</option>
                            <option value="Tonkinese" {{ request('breed') == 'Tonkinese' ? 'selected' : '' }}>Tonkinese</option>
                            <option value="Balalaika" {{ request('breed') == 'Balalaika' ? 'selected' : '' }}>Balalaika</option>
                            <option value="Burmese" {{ request('breed') == 'Burmese' ? 'selected' : '' }}>Burmese</option>
                            <option value="Chartreux" {{ request('breed') == 'Chartreux' ? 'selected' : '' }}>Chartreux</option>
                            <option value="Cornish Rex" {{ request('breed') == 'Cornish Rex' ? 'selected' : '' }}>Cornish Rex</option>
                            <option value="Exotic Shorthair" {{ request('breed') == 'Exotic Shorthair' ? 'selected' : '' }}>Exotic Shorthair</option>
                            <option value="Himalayan" {{ request('breed') == 'Himalayan' ? 'selected' : '' }}>Himalayan</option>
                            <option value="Japanese Bobtail" {{ request('breed') == 'Japanese Bobtail' ? 'selected' : '' }}>Japanese Bobtail</option>
                            <option value="Korat" {{ request('breed') == 'Korat' ? 'selected' : '' }}>Korat</option>
                            <option value="LaPerm" {{ request('breed') == 'LaPerm' ? 'selected' : '' }}>LaPerm</option>
                            <option value="Munchkin" {{ request('breed') == 'Munchkin' ? 'selected' : '' }}>Munchkin</option>
                            <option value="Oriental" {{ request('breed') == 'Oriental' ? 'selected' : '' }}>Oriental</option>
                            <option value="Russian Blue" {{ request('breed') == 'Russian Blue' ? 'selected' : '' }}>Russian Blue</option>
                            <option value="Scottish Fold" {{ request('breed') == 'Scottish Fold' ? 'selected' : '' }}>Scottish Fold</option>
                            <option value="Savannah" {{ request('breed') == 'Savannah' ? 'selected' : '' }}>Savannah</option>
                            <option value="Somali" {{ request('breed') == 'Somali' ? 'selected' : '' }}>Somali</option>
                            <option value="Tonkinese" {{ request('breed') == 'Tonkinese' ? 'selected' : '' }}>Tonkinese</option>
                            <option value="Turkish Angora" {{ request('breed') == 'Turkish Angora' ? 'selected' : '' }}>Turkish Angora</option>
                            <option value="Turkish Van" {{ request('breed') == 'Turkish Van' ? 'selected' : '' }}>Turkish Van</option>
                            <option value="Yorkshire Terrier" {{ request('breed') == 'Yorkshire Terrier' ? 'selected' : '' }}>Yorkshire Terrier</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-boho-brown">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                        </div>
                    </div>
                    <button type="submit" class="bg-boho-brown text-white px-8 py-3 rounded-xl hover:bg-opacity-90 transition-all shadow-md font-semibold tracking-wide">
                        Filter
                    </button>
                    @if(request('breed'))
                        <a href="{{ route('cats.index') }}" class="flex items-center justify-center px-4 text-boho-brown hover:text-boho-orange transition-colors">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($cats as $cat)
                    <div class="bg-white group rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-boho-light flex flex-col h-full">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $cat->image }}" alt="{{ $cat->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-md p-2 rounded-full shadow-lg text-boho-brown transform translate-y-[-10px] opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                                <svg class="w-5 h-5 fill-current text-boho-orange" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            </div>
                            
                            <span class="absolute top-4 left-4 bg-boho-brown/90 backdrop-blur-sm text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm">
                                {{ $cat->status }}
                            </span>
                        </div>
                        
                        <div class="p-6 flex flex-col flex-grow relative">
                            <!-- Decorative bg pattern could go here -->
                            
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-2xl font-serif font-bold text-boho-brown group-hover:text-boho-orange transition-colors">
                                    {{ $cat->name }}
                                </h3>
                                <span class="bg-boho-bg text-boho-brown text-sm font-bold px-3 py-1 rounded-lg border border-boho-cream">
                                    {{ $cat->age }}
                                </span>
                            </div>
                            
                            <div class="flex-grow">
                                <div class="flex flex-wrap gap-2 mb-4 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                    <span class="flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-boho-orange"></span>
                                        {{ $cat->breed }}
                                    </span>
                                    <span class="flex items-center gap-1 ml-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                        {{ $cat->gender }}
                                    </span>
                                </div>
                                
                                <p class="text-gray-600 text-sm line-clamp-3 leading-relaxed mb-6">
                                    {{ $cat->description }}
                                </p>
                            </div>

                            <a href="{{ route('cats.show', $cat) }}"
                                class="w-full text-center border border-boho-brown text-boho-brown font-bold py-3 rounded-xl transition-all hover:bg-boho-brown hover:text-white hover:shadow-lg focus:ring-2 focus:ring-boho-brown focus:ring-offset-2">
                                Meet {{ $cat->name }}
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="inline-block p-6 rounded-full bg-boho-light mb-4 text-boho-brown">
                            <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-serif font-bold text-gray-600 mb-2">No cats found</h3>
                        <p class="text-gray-500">Try adjusting your filter or check back later.</p>
                        @if(request('breed'))
                             <a href="{{ route('cats.index') }}" class="inline-block mt-4 text-boho-orange font-bold hover:underline">View all cats</a>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>