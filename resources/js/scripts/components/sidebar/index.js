import Alpine from 'alpinejs'

export function sidebar() {
  return {
    init() {
      const sidebar = document.getElementById('sidebar-menu')
      const links = sidebar.querySelectorAll('li a')
      let current = 0
      for (var i = 0; i < links.length; i++) {
        if (links[i].href === document.URL) {
          current = i
        }
      }
      links[current].className =
        'flex items-center gap-4 py-3 rounded-lg bg-primary-200 dark:bg-primary-600/20 text-primary-600 dark:text-primary-500'
    },
    foldSidebar() {
      Alpine.store('app').isLayoutCompact = true
    },
  }
}
