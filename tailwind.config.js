/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#0071e3',
          dark: '#0077ED',
          light: '#2997FF',
          50: '#f0f9ff',
          100: '#e0f2fe',
          200: '#bae6fd',
          300: '#7dd3fc',
          400: '#38bdf8',
          500: '#0071e3',
          600: '#0077ED',
          700: '#0369a1',
          800: '#075985',
          900: '#0c4a6e',
        },
        accent: {
          DEFAULT: '#FF9500',
          dark: '#FF6D00',
          light: '#FFB800',
        },
        dark: '#1d1d1f',
        gray: {
          DEFAULT: '#6e6e73',
          light: '#f5f5f7',
        },
      },
      fontFamily: {
        sans: ['-apple-system', 'BlinkMacSystemFont', 'SF Pro Display', 'Inter', 'Segoe UI', 'sans-serif'],
        display: ['-apple-system', 'BlinkMacSystemFont', 'SF Pro Display', 'Inter', 'sans-serif'],
      },
      letterSpacing: {
        'apple': '-0.015em',
        'apple-tight': '-0.025em',
      },
      lineHeight: {
        'apple': '1.47059',
        'apple-tight': '1.05',
      },
      borderRadius: {
        'apple': '18px',
        'capsule': '980px',
      },
      transitionTimingFunction: {
        'apple': 'cubic-bezier(0.28, 0.11, 0.32, 1)',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
