import { layout } from './layout'
import { navbar } from './navbar'
import { sidebar } from './sidebar'
import { search } from './search'
import { backtotop } from './backtotop'
import { boxCarousel } from './carousel'
import { video } from './video'
import { collapse } from './collapse'
import { dropdown } from './dropdown'
import { dropFilter } from './dropfilter'
import { gallery } from './gallery'
import { tabs } from './tabs'
import { wizard } from './wizard'
import { format } from './format'
// Dev Vboy auth

// import http from './auth'
// import {token} from './token';
//auth

// const toke = 1234;

window.layout = layout
window.navbar = navbar
window.sidebar = sidebar
window.search = search
window.backtotop = backtotop
window.boxCarousel = boxCarousel
window.video = video
window.collapse = collapse
window.gallery = gallery
window.dropdown = dropdown
window.dropFilter = dropFilter
window.tabs = tabs
window.wizard = wizard



// Dev Vboy define Base URL



window.format = format


window.dateFormat = (dateString) => {
  const date = new Date(dateString);
  if (isNaN(date)) {
    return 'loading';
  }
  const options = {
      year: "numeric",
      month: "short",
      day: "numeric",
      hour: "numeric",
      minute: "numeric",
      second: "numeric",
      hour12: true,
  };
  return date.toLocaleDateString("en-US", options);
};

window.truncateString = (str, maxLength) => {
  if (str.length <= maxLength) {
      return str;
  } else {
      return str.slice(0, maxLength) + '...';
  }
}

// window.saveToken = token
// End of base url
