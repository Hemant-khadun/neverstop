import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    theme: {
        extend: {
          colors: {
            // Change primary colors
            primary: {
              50: '#F0F9FF',
              100: '#E0F2FE',
              200: '#BAE6FD',
              300: '#7DD3FC',
              400: '#38BDF8',
              500: '#0EA5E9',
              600: '#0284C7',
              700: '#0369A1',
              800: '#075985',
              900: '#0C4A6E',
            },
            // Define additional colors as needed
            secondary: {
              // Shades of green
              50: '#F0FFF4',
              100: '#C6F6D5',
              200: '#9AE6B4',
              300: '#68D391',
              400: '#48BB78',
              500: '#38A169',
              600: '#2F855A',
              700: '#276749',
              800: '#22543D',
              900: '#1C4532',
            },
          },
        },
      },
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
