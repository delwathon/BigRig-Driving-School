function searchJSON(searchTerm, url) {
  const resultsContainer = document.getElementById('search-results')
  const expression = new RegExp(searchTerm, 'i')

  resultsContainer.innerHTML = ''
  resultsContainer.classList.remove('hidden')

  if (searchTerm.length > 0) {
    fetch(url)
      .then((resp) => resp.json())
      .then(function (data) {
        // console.log(data)
        if (data.length > 0) {
          data.forEach(function (value) {
            if (
              value.title.search(expression) != -1 ||
              value.content.search(expression) != -1
            ) {
              let template = `
                  <a href="${value.url}" class="search-result group flex items-center gap-2 p-2 rounded-lg hover:bg-muted-50 dark:hover:bg-muted-800">
                      <div class="w-10 h-10 flex items-center justify-center mask mask-blob bg-transparent group-hover:bg-primary-100 dark:group-hover:bg-primary-500/20 text-primary-500 transition-colors duration-300">
                        <i class="iconify w-5 h-5 block" data-icon="${value.icon}"></i>
                      </div>
                      <div class="meta font-sans leading-tight">
                          <h4 class="text-sm text-muted-600 dark:text-muted-100">${value.title}</h4 >
                          <span class="text-xs text-muted-400">${value.content}</span>
                      </div>
                  </a>
              `
              // console.log(template)
              resultsContainer.innerHTML += template
            }
          })
          const results = resultsContainer.querySelectorAll('.search-result')
          if (results.length === 0) {
            let placeholder = `
                <div class="w-full p-6">
                    <div class="text-center">
                        <i class="iconify w-8 h-8 mx-auto text-muted-400" data-icon="ph:robot-duotone"></i>
                        <h3 class="font-heading font-medium text-muted-800 dark:text-muted-100">No Matching Results</h3>
                        <p class="font-heading text-xs max-w-[240px] mx-auto text-muted-400">Sorry, we couldn't find any matching records. Please try different search terms.</p>
                    </div>
                </div>
            `

            resultsContainer.innerHTML += placeholder
          }
        }
      })
      .catch(function (error) {
        // console.log(error)
      })
  } else {
    resultsContainer.classList.add('hidden')
  }
}

export function search() {
  return {
    searchTerms: '',
    closeSearch() {
      const resultsContainer = document.getElementById('search-results')
      this.$store.app.searchOpened = !this.$store.app.searchOpened
      this.searchTerms = ''
      resultsContainer.classList.add('hidden')
    },
    searchData() {
      let searchTerm = this.searchTerms
      searchJSON(searchTerm, '/data/search.json')
    },
  }
}
