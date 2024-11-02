/** @type {import('tailwindcss').Config} */
export default {
  // content: [],
  // theme: {
  //   extend: {},
  // },
  // plugins: [],




  content: [
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		'./resources/js/**/*.js',  // Include your own JavaScript files
		"./node_modules/flowbite/**/*.js",
	],
	
	theme: {
	  extend: {
		screens: {
		  xs: { max: '639px' },
		  sm: '640px',
		  md: '768px',
		  lg: '1025px',
		  xl: '1280px',
		  xxl: '1536px',
		  ptablet: {
			raw: '(min-width: 768px) and (max-width: 1024px) and (orientation: portrait)',
		  },
		  ltablet: {
			raw: '(min-width: 768px) and (max-width: 1024px) and (orientation: landscape)',
		  },
		},
		colors: {
		  slate: {
			1000: '#0a101f',
		  },
		  gray: {
			1000: '#080c14',
		  },
		  zinc: {
			1000: '#101012',
		  },
		  neutral: {
			1000: '#080808',
		  },
		  stone: {
			1000: '#0f0d0c',
		  },
		  golden: {
			1000: '#ffd700', // Replace this with your desired golden color code
		  },
		  muted: {
			...colors.slate,
			1000: '#0a101f',
		  },
		  primary: colors.yellow,
  
		  info: colors.sky,
		  success: colors.teal,
		  warning: colors.amber,
		  danger: colors.rose,
		  welcome:colors.gray,
		},
		fontFamily: {
		  sans: ['Roboto Flex', 'sans-serif'],
		  heading: ['Inter', 'sans-serif'],
		},
		typography: ({ theme }) => ({
		  DEFAULT: {
			css: {
			  color: theme('colors.muted.600'),
			  '[class~="lead"]': {
				color: theme('colors.muted.400'),
			  },
			  h2: {
				fontFamily: theme('fontFamily.heading'),
				fontWeight: 700,
				color: theme('colors.muted.800'),
			  },
			  h3: {
				fontFamily: theme('fontFamily.heading'),
				fontWeight: 500,
				color: theme('colors.muted.800'),
			  },
			  h4: {
				fontFamily: theme('fontFamily.heading'),
				fontWeight: 500,
				fontSize: '1.25em',
				color: theme('colors.muted.800'),
			  },
			  hr: {
				borderColor: theme('colors.muted.200'),
			  },
			  li: {
				fontSize: '1.15rem',
				color: theme('colors.muted.600'),
				padding: '0.35rem 0',
			  },
			  strong: {
				color: theme('colors.muted.800'),
			  },
			  em: {
				color: theme('colors.muted.500'),
				fontSize: '1.1rem',
				lineHeight: 1,
			  },
			  blockquote: {
				fontSize: '1.1rem',
				lineHeight: 1.4,
				fontWeight: 500,
				color: theme('colors.muted.500'),
				borderLeftColor: theme('colors.primary.500'),
				background: theme('colors.muted.100'),
				padding: '1.75rem',
			  },
			  pre: {
				fontFamily: theme('fontFamily.mono'),
			  },
			  code: {
				fontFamily: theme('fontFamily.mono'),
				background: theme('colors.primary.100'),
				color: theme('colors.primary.500'),
				padding: '0.35rem',
				fontWeight: 600,
				fontSize: '0.95rem !important',
			  },
			},
		  },
		//   dark: {
		// 	css: {
		// 	  color: theme('colors.muted.400'),
		// 	  '[class~="lead"]': {
		// 		color: theme('colors.muted.300'),
		// 	  },
		// 	  h2: {
		// 		color: theme('colors.muted.100'),
		// 	  },
		// 	  h3: {
		// 		color: theme('colors.muted.100'),
		// 	  },
		// 	  h4: {
		// 		color: theme('colors.muted.100'),
		// 	  },
		// 	  hr: {
		// 		borderColor: theme('colors.muted.800'),
		// 	  },
		// 	  li: {
		// 		color: theme('colors.muted.400'),
		// 	  },
		// 	  strong: {
		// 		color: theme('colors.muted.300'),
		// 	  },
		// 	  em: {
		// 		color: theme('colors.muted.400'),
		// 	  },
		// 	  blockquote: {
		// 		color: theme('colors.muted.200'),
		// 		background: theme('colors.muted.800'),
		// 	  },
		// 	},
		//   },
		}),
		keyframes: {
		  indeterminate: {
			'0%': { 'margin-left': '-10%' },
			'100%': { 'margin-left': '100%' },
		  },
		  placeload: {
			'0%': { 'background-position': '-468px 0' },
			'100%': { 'background-position': '468px 0' },
		  },
		  stroke: {
			'100%': { 'stroke-dashoffset': '0' },
		  },
		  scale: {
			0: { transform: 'scale(0)', opacity: 0 },
			'100%': { transform: 'scale(1)', opacity: 1 },
		  },
		},
		animation: {
		  indeterminate: 'indeterminate 1s cubic-bezier(0.4, 0, 0.2, 1) infinite',
		  placeload: 'placeload 1s linear infinite forwards',
		  circle: 'stroke 1.2s cubic-bezier(0.65, 0, 0.45, 1) forwards',
		  check: 'stroke 0.9s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards',
		  scale: 'scale 0.5s linear 0.5s forwards',
		},
	  },
	},
	variants: {
	  extend: {},
	},
	plugins: [
	//   require('flowbite/plugin'),
	 require('flowbite/plugin')({
      charts: true,
  }),
	  require('@tailwindcss/typography'),
	  require('@tailwindcss/line-clamp'),
	  require('@tailwindcss/aspect-ratio'),
	  require('vidstack/tailwind.cjs'),
	  plugin(function ({ addUtilities }) {
		addUtilities({
		  '.slimscroll::-webkit-scrollbar': {
			width: '6px',
		  },
		  '.slimscroll::-webkit-scrollbar-thumb': {
			borderRadius: '.75rem',
			background: 'rgba(0, 0, 0, 0.1)',
		  },
		  '.slimscroll-opaque::-webkit-scrollbar-thumb': {
			background: 'rgba(0, 0, 0, 0) !important',
		  },
		  '.mask': {
			'mask-size': 'contain',
			'mask-repeat': 'no-repeat',
			'mask-position': 'center',
		  },
		  '.mask-hex': {
			'mask-image':
			  "url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjE4MiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNNjQuNzg2IDE4MS40Yy05LjE5NiAwLTIwLjA2My02LjY4Ny0yNS4wNzktMTQuMjFMMy43NjIgMTA1LjMzYy01LjAxNi04LjM2LTUuMDE2LTIwLjkgMC0yOS4yNTlsMzUuOTQ1LTYxLjg2QzQ0LjcyMyA1Ljg1MSA1NS41OSAwIDY0Ljc4NiAwaDcxLjA1NWM5LjE5NiAwIDIwLjA2MyA2LjY4OCAyNS4wNzkgMTQuMjExbDM1Ljk0NSA2MS44NmM0LjE4IDguMzYgNC4xOCAyMC44OTkgMCAyOS4yNThsLTM1Ljk0NSA2MS44NmMtNC4xOCA4LjM2LTE1Ljg4MyAxNC4yMTEtMjUuMDc5IDE0LjIxMUg2NC43ODZ6Ii8+PC9zdmc+')",
		  },
		  '.mask-hexed': {
			'mask-image':
			  "url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgyIiBoZWlnaHQ9IjIwMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNLjMgNjUuNDg2YzAtOS4xOTYgNi42ODctMjAuMDYzIDE0LjIxMS0yNS4wNzhsNjEuODYtMzUuOTQ2YzguMzYtNS4wMTYgMjAuODk5LTUuMDE2IDI5LjI1OCAwbDYxLjg2IDM1Ljk0NmM4LjM2IDUuMDE1IDE0LjIxMSAxNS44ODIgMTQuMjExIDI1LjA3OHY3MS4wNTVjMCA5LjE5Ni02LjY4NyAyMC4wNjMtMTQuMjExIDI1LjA3OWwtNjEuODYgMzUuOTQ1Yy04LjM2IDQuMTgtMjAuODk5IDQuMTgtMjkuMjU4IDBsLTYxLjg2LTM1Ljk0NUM2LjE1MSAxNTcuNDQuMyAxNDUuNzM3LjMgMTM2LjU0VjY1LjQ4NnoiLz48L3N2Zz4=')",
		  },
		  '.mask-deca': {
			'mask-image':
			  "url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTkyIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNOTYgMGw1OC43NzkgMTkuMDk4IDM2LjMyNyA1MHY2MS44MDRsLTM2LjMyNyA1MEw5NiAyMDBsLTU4Ljc3OS0xOS4wOTgtMzYuMzI3LTUwVjY5LjA5OGwzNi4zMjctNTB6IiBmaWxsLXJ1bGU9ImV2ZW5vZGQiLz48L3N2Zz4=')",
		  },
		  '.mask-blob': {
			'mask-image':
			  "url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMTAwIDBDMjAgMCAwIDIwIDAgMTAwczIwIDEwMCAxMDAgMTAwIDEwMC0yMCAxMDAtMTAwUzE4MCAwIDEwMCAweiIvPjwvc3ZnPg==')",
		  },
		  '.mask-diamond': {
			'mask-image':
			  "url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMTAwIDBsMTAwIDEwMC0xMDAgMTAwTDAgMTAweiIgZmlsbC1ydWxlPSJldmVub2RkIi8+PC9zdmc+')",
		  },
		})
	  }),
	  
	  plugin(function ({ addComponents }) {
		addComponents({
		  '.placeload': {
			position: 'relative',
			background:
			  'linear-gradient(to right, rgb(148 163 184 / 20%) 8%, rgb(148 163 184 / 30%) 18%, rgb(148 163 184 / 20%) 33%)',
			'background-size': '800px 104px',
			color: 'transparent !important',
		  },
		  /*'.dark .placeload': {
			background:
			  'linear-gradient(to right, rgb(255 255 255 / 15%) 8%, rgb(255 255 255 / 24%) 18%, rgb(255 255 255 / 15%) 33%)',
		  },*/
		})
	  }),
	  function ({ addVariant }) {
		addVariant('child', '& > *')
		addVariant('child-hover', '& > *:hover')
	  },
	  function ({ addBase, theme }) {
		function extractColorVars(colorObj, colorGroup = '') {
		  return Object.keys(colorObj).reduce((vars, colorKey) => {
			const value = colorObj[colorKey]
  
			const newVars =
			  typeof value === 'string'
				? { [`--color${colorGroup}-${colorKey}`]: value }
				: extractColorVars(value, `-${colorKey}`)
  
			return { ...vars, ...newVars }
		  }, {})
		}
  
		addBase({
		  ':root': extractColorVars(theme('colors')),
		})
	  },
	],
}

