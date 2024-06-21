<template>
  <div class="w-full flex justify-center">
    <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4">
      <div v-for="offer in offers" :key="offer.hotelId"
           class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <img class="rounded-t-lg min-w-full h-80" :src="offer.image" @error="imageUrlAlt"/>
        <div class="p-5">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ offer.name }}</h5>
          <div class="flex">
            <svg v-for="i in parseInt(offer.star)" :key="i"  class="w-[24px] h-[24px] text-gray-800 dark:text-white"
                 aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
              <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142
                3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436
                2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
            </svg>
          </div>
          <p>{{ offer.city }} {{ offer.country }}</p>
          <p>{{ offer.price }}</p>
        </div>
      </div>
    </div>
  </div>


  <div class="flex items-center justify-center border-t border-gray-200 bg-white px-4 py-10 sm:px-6 mt-4">
    <div class="flex flex-1 justify-between sm:hidden">
      <span @click="prevPage" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4
        py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</span>
      <span @click="nextPage" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white
        px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</span>
    </div>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between max-w-6xl">
      <div :class="{ hidden: this.totalPages === 1 }">
        <p class="text-sm text-gray-700">
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
      <div class="cursor-pointer">
        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
          <span @click="prevPage"
                class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1
                ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
            </svg>
          </span>

          <span v-for="page in paginationPages()" @click="changePage(page)" aria-current="page"
             class="relative inline-flex items-center px-4 py-2 text-sm font-semibold focus:z-20"
             :class="pageButtonClass(page)"
          >{{ page }}</span>

          <span @click="nextPage"
                class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset
                ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
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
      activeButtonClass: 'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 ' +
          'focus-visible:outline-offset-2 focus-visible:outline-indigo-600',
      inactiveButtonClass: 'relative text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0'
    };
  },
  mounted() {
    this.fetchOffers();
  },
  methods: {
    fetchOffers() {
      fetch(`/api/offers?page=${this.currentPage}`)
        .then(response => response.json())
        .then(data => {
          this.offers = data.offers;
          this.currentPage = data.pager.currentPage;
          this.totalPages = data.pager.totalPages;
          this.totalItems = data.pager.totalItems;
          this.perPage = data.pager.perPage;
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
    }
  }
};
</script>
