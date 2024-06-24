<template>
  <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <span class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Best Offers Logo">
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Best Offers</span>
      </span>
      <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

        <button type="button" @click="toggleDarkTheme" class="inset-y-0 end-0 flex items-center pe-3">
          <svg class="w-[16px] h-[16px] text-white hidden dark:block" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 5V3m0 18v-2M7.05 7.05 5.636 5.636m12.728 12.728L16.95 16.95M5 12H3m18 0h-2M7.05 16.95l-1.414
              1.414M18.364 5.636 16.95 7.05M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"></path>
          </svg>
          <svg class="w-[16px] h-[16px] text-gray-800 block dark:hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 21a9 9 0 0 1-.5-17.986V3c-.354.966-.5 1.911-.5 3a9 9 0 0 0 9 9c.239 0 .254.018.488 0A9.004 9.004 0
              0 1 12 21Z"></path>
          </svg>
        </button>

        <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10
          justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2
          focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky"
          aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
        </button>
      </div>
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
        <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8
          rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900
          dark:border-gray-700">
          <!-- City -->
          <li>
            <button @click="toggleFilter('city')" class="flex items-center justify-between w-full py-2 px-3
              text-gray-900 rounded hover:bg-gray-100
              md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white
              md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700
              md:dark:hover:bg-transparent">
              City
              <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg></button>
            <div :class="{ hidden: this.hiddenFilterDropdowns.city }"
              class="z-10 absolute w-48 max-h-80 overflow-auto bg-white divide-y divide-gray-100 rounded-lg shadow
              dark:bg-gray-700 dark:divide-gray-600">
              <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200">
                <li v-for="city in cities">
                  <label :for="`city-id-${ city.cityId }`" class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="flex items-center h-5">
                      <input :id="`city-id-${ city.cityId }`" @change="citySearch(city.cityId)" type="checkbox"
                        value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500
                        dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2
                        dark:bg-gray-600 dark:border-gray-500">
                    </div>
                    <div class="ms-2 text-sm">
                      <span class="font-medium text-gray-900 dark:text-gray-300">
                        <div>{{ city.name }}</div>
                      </span>
                    </div>
                  </label>
                </li>
              </ul>
            </div>
          </li>
          <!-- Country -->
          <li>
            <button @click="toggleFilter('country')" class="flex items-center justify-between w-full py-2 px-3
              text-gray-900 rounded hover:bg-gray-100
              md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white
              md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700
              md:dark:hover:bg-transparent">
              Country
              <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
              </svg></button>
            <div :class="{ hidden: this.hiddenFilterDropdowns.country }"
                 class="z-10 absolute w-48 max-h-80 overflow-auto bg-white divide-y divide-gray-100 rounded-lg shadow
              dark:bg-gray-700 dark:divide-gray-600">
              <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200">
                <li v-for="country in countries">
                  <label :for="`country-id-${ country.countryId }`" class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="flex items-center h-5">
                      <input :id="`country-id-${ country.countryId }`" @change="countrySearch(country.countryId)" type="checkbox"
                             value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500
                        dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2
                        dark:bg-gray-600 dark:border-gray-500">
                    </div>
                    <div class="ms-2 text-sm">
                      <span class="font-medium text-gray-900 dark:text-gray-300">
                        <div>{{ country.name }}</div>
                      </span>
                    </div>
                  </label>
                </li>
              </ul>
            </div>
          </li>
          <!-- Sort -->
          <li>
            <button @click="toggleFilter('sort')" class="flex items-center justify-between w-full py-2 px-3
              text-gray-900 rounded hover:bg-gray-100
              md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white
              md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700
              md:dark:hover:bg-transparent">
              Sort
              <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
              </svg></button>
            <div :class="{ hidden: this.hiddenFilterDropdowns.sort }"
              class="z-10 absolute w-48 max-h-80 overflow-auto bg-white divide-y divide-gray-100 rounded-lg shadow
                dark:bg-gray-700 dark:divide-gray-600">
              <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200">
                <li v-for="(sort, sortId) in sorts">
                  <label class="flex items-center" :for="`sort-id-${sortId}`">
                    <input :id="`sort-id-${sortId}`" @change="sorting(sortId)" type="radio" value="" :checked="sortId == 1"
                      name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500
                        dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2
                        dark:bg-gray-600 dark:border-gray-500">
                    <span class="text-sm font-medium text-gray-900 dark:text-gray-300 ms-2">{{ sort.name }}</span>

                    <svg class="w-[15px] h-[15px] text-gray-800 dark:text-white " aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        :d="`M12 ${sort.direction === 'asc' ? '6v13m0-13 4 4m-4-4-4 4' : '19V5m0 14-4-4m4 4 4-4'}`"/>
                    </svg>
                  </label>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="w-full flex justify-center pt-20">
    <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4">
      <div v-for="offer in offers" :key="offer.hotelId"
           class="flex flex-col max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <img class="rounded-t-lg min-w-full h-80" :src="offer.image" @error="imageUrlAlt"/>
        <div class="flex flex-col flex-1 p-5">
          <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ offer.name }}</h5>
          <div class="flex">
            <svg v-for="i in parseInt(offer.star)" :key="i"  class="w-[24px] h-[24px] text-amber-400"
                 aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
              <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142
                3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436
                2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
            </svg>
          </div>
          <p class="text-gray-700 dark:text-gray-400 mb-2">{{ offer.cityName }}, {{ offer.countryName }}</p>
          <p class="text-xl text-right mt-auto text-emerald-500 border-t-gray-500 dark:border-t-emerald-500
            border-t-2 pt-1">{{ offer.roundedPrice }} €</p>
        </div>
      </div>
    </div>
  </div>


  <div class="flex items-center justify-center border-t border-gray-200 dark:border-gray-700 bg-white px-4 py-10
    sm:px-6 mt-4 dark:bg-gray-800" :class="{'hidden': !this.totalItems}">
    <div class="flex flex-1 justify-between sm:hidden">
      <span @click="prevPage" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4
        py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</span>
      <span @click="nextPage" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white
        px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</span>
    </div>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between max-w-6xl">
      <div :class="{ hidden: this.totalPages === 1 }">
        <p class="text-sm text-gray-700 dark:text-white">
          Showing
          {{ ' ' }}
          <span class="font-medium">{{ (this.currentPage - 1) * this.perPage + 1 }}</span>
          {{ ' ' }}
          to
          {{ ' ' }}
          <span class="font-medium">{{ Math.min(this.currentPage * this.perPage, this.totalItems) }}</span>
          {{ ' ' }}
          of
          {{ ' ' }}
          <span class="font-medium">{{ this.totalItems }}</span>
          {{ ' ' }}
          results
        </p>
      </div>
      <div class="cursor-pointer" :class="{ hidden: this.totalPages === 1 }">
        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
          <span @click="prevPage"
                class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1
                ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 dark:hover:bg-black">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
            </svg>
          </span>

          <span v-for="page in paginationPages()" @click="changePage(page)" aria-current="page"
             class="relative inline-flex items-center px-4 py-2 text-sm font-semibold focus:z-20 dark:text-white dark:hover:text-black"
             :class="pageButtonClass(page)"
          >{{ page }}</span>

          <span @click="nextPage"
                class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset
                ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 hover:dark:bg-black">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
            </svg>
          </span>
        </nav>
      </div>
    </div>
  </div>


</template>

<script>
export default {
  data() {
    return {
      offers: [],
      currentPage: 1,
      totalPages: 1,
      totalItems: 0,
      perPage: 21,
      direction: 'asc',
      orderBy: 'price',
      activeButtonClass: 'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 ' +
          'focus-visible:outline-offset-2 focus-visible:outline-indigo-600',
      inactiveButtonClass: 'relative text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0',
      cities: [],
      countries: [],
      sorts: {
        1: {'name': 'price', 'direction': 'asc'},
        2: {'name': 'price', 'direction': 'desc'},
        3: {'name': 'star', 'direction': 'asc'},
        4: {'name': 'star', 'direction': 'desc'},
      },
      selectedCityIds: [],
      selectedCountryIds: [],
      hiddenFilterDropdowns: {
        city: true,
        country: true,
        sort: true,
      }
    };
  },
  mounted() {
    this.fetchOffers();
    this.fetchFilters();
    // Apply dark theme if it was set in local storage.
    if (localStorage.getItem('darkMode') === 'true') {
      document.body.classList.add('dark');
    }
  },
  methods: {
    fetchOffers() {
      fetch(`/api/offers?page=${this.currentPage}&order_by=${this.orderBy}&direction=${this.direction}&cityIds=${this.selectedCityIds}&countryIds=${this.selectedCountryIds}`)
        .then(response => response.json())
        .then(data => {
          this.offers = data.offers;
          this.currentPage = data.pager.currentPage;
          this.totalPages = data.pager.totalPages;
          this.totalItems = data.pager.totalItems;
          this.perPage = data.pager.perPage;
      });
    },
    fetchFilters() {
      fetch(`/api/filters`)
        .then(response => response.json())
        .then(data => {
          this.cities = data.cities;
          this.countries = data.countries;
        });
    },
    changePage(page) {
      if (!isNaN(page)) {
        this.currentPage = page;
        this.fetchOffers();
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
        this.fetchOffers();
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
        this.fetchOffers();
      }
    },
    pageButtonClass(page) {
      return page === this.currentPage ? this.activeButtonClass : this.inactiveButtonClass;
    },
    paginationPages() {
      const pages = [];
      if (this.totalPages <= 6) {
        for (let i = 1; i <= this.totalPages; i++) {
          pages.push(i);
        }
      } else {
        if (this.currentPage <= 3) {
          pages.push(1, 2, 3, 4, '...', this.totalPages - 1, this.totalPages);
        } else if (this.currentPage > this.totalPages - 3) {
          pages.push(1, 2, '...', this.totalPages - 3, this.totalPages - 2, this.totalPages - 1, this.totalPages);
        } else {
          pages.push(1, 2, '...', this.currentPage - 1, this.currentPage, this.currentPage + 1, '...', this.totalPages - 1, this.totalPages);
        }
      }
      return pages;
    },
    imageUrlAlt(event) {
      // offer image is changed with alt image if url is broken
      event.target.src = "https://fakeimg.pl/382x320/?text=No+Image"
    },
    toggleDarkTheme() {
      let darkModeEnabled = document.body.classList.contains('dark');
      document.body.classList.toggle('dark', !darkModeEnabled);
      localStorage.setItem('darkMode', `${!darkModeEnabled}`);
    },
    citySearch(cityId) {
      const index = this.selectedCityIds.indexOf(cityId);
      if (index !== -1) {
        this.selectedCityIds.splice(index, 1);
      } else {
        this.selectedCityIds.push(cityId);
      }
      this.fetchOffers();
    },
    countrySearch(countryId) {
      const index = this.selectedCountryIds.indexOf(countryId);
      if (index !== -1) {
        this.selectedCountryIds.splice(index, 1);
      } else {
        this.selectedCountryIds.push(countryId);
      }
      this.fetchOffers();
    },
    sorting(sortId) {
      this.orderBy = this.sorts[sortId].name;
      this.direction = this.sorts[sortId].direction;
      this.fetchOffers();
    },
    toggleFilter(filter) {
      for (const [key, value] of Object.entries(this.hiddenFilterDropdowns)) {
        key === filter
          ? this.hiddenFilterDropdowns[filter] = !this.hiddenFilterDropdowns[filter]
          : this.hiddenFilterDropdowns[key] = true;
      }
    }
  }
};
</script>
