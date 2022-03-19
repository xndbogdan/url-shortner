@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="px-3 py-4 mb-4 text-sm text-green-700 bg-green-100 border border-t-8 border-green-600 rounded" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex flex-col my-16 break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="px-6 py-5 font-semibold text-white bg-blue-900 sm:py-6 sm:px-8 sm:rounded-t-md">
                Create Short Url 
            </header>

            <form class="w-full p-6" method="POST" action="{{ route('url.store') }}">
                @method("post")
                @csrf
                <div>
                    <label for="destination" class="block text-sm font-medium text-gray-700">Url</label>
                    <div class="mt-1">
                        <input type="url" name="destination" id="destination" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="https://example.com" aria-describedby="email-description">
                    </div>
                    @if ($errors->any())
                        @error('destination')
                            <p class="mt-2 text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    @else
                        <p class="mt-2 text-sm text-gray-500" id="email-description">Enter the url that you want to shorten.</p>
                    @endif
                </div>
                <div class="flex flex-wrap justify-center mt-8 md:justify-end md:my-0">
                    <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Shorten Url</button>
                </div>
            </form>
            
        </section>

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="px-6 py-5 font-semibold text-white bg-blue-900 sm:py-6 sm:px-8 sm:rounded-t-md">
                Shortened Urls Listing
            </header>

            @if(!$urls->count())
              <div class="py-8">
                  <div class="text-center">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-400" fill="currentColor" viewBox="0 0 24 24" stroke="none" aria-hidden="true">
                          <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.337.458l-3.937 3.936c-2.449-1.466-5.67-1.144-7.78.966l-4.261 4.262c-2.11 2.11-2.433 5.331-.968 7.78l-3.935 3.935c-.609.609-.609 1.597 0 2.207s1.598.609 2.207 0l3.935-3.935c2.449 1.465 5.67 1.144 7.78-.967l4.261-4.261c2.11-2.11 2.433-5.331.968-7.781l3.936-3.936c.609-.609.609-1.597 0-2.207s-1.597-.609-2.206.001zm-4.862 11.757l-4.261 4.261c-.895.894-2.176 1.169-3.31.827l1.632-1.632c.609-.609.609-1.597 0-2.207s-1.598-.609-2.207 0l-1.631 1.632c-.343-1.133-.067-2.415.826-3.309l4.261-4.261c.895-.894 2.176-1.169 3.31-.827l-1.631 1.63c-.609.609-.609 1.597 0 2.207s1.598.609 2.207 0l1.63-1.63c.343 1.133.067 2.415-.826 3.309z"/>
                      </svg>
                      <h3 class="mt-2 text-sm font-medium text-gray-900">No links</h3>
                      <p class="mt-1 text-sm text-gray-500">Get started by creating a new link.</p> 
                  </div>
              </div>
            @else
              <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col mt-8">
                  <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                      <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                          <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">Slug</th>
                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Url</th>
                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Created At</th>
                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Actions</th>
                          </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                          @foreach($urls as $url)
                            <tr>
                              <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6 md:pl-0"><a href="{{ $url->shortened_url }}" target="blank">{{ $url->shortened_url }}</a></td>
                              <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $url->destination }}</td>
                              <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $url->created_at }}</td>
                              <td class="px-3 py-4 text-sm text-red-500 whitespace-nowrap">
                                <form action="{{ route('url.destroy', ['url' => $url]) }}" method="post">
                                @method('delete')
                                @csrf
                                  <button>Delete</button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            @endif
        </section>
    </div>
</main>
@endsection
