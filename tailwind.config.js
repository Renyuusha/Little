/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                cream: '#FFF8F0',
                warmwhite: '#FFFDF9',
                pink: {
                    soft: '#FBD3E9',
                    deep: '#F49AC2',
                },
                peach: '#FFD9B7',
                lavender: '#E4D9FF',
                babyblue: '#CFEFFF',
                yellow: {
                    soft: '#FFF3B0',
                },
            },
            fontFamily: {
                display: ['"Fredoka"', 'sans-serif'],
                body: ['"Quicksand"', 'sans-serif'],
            },
            boxShadow: {
                soft: '0 8px 30px rgba(180, 150, 200, 0.15)',
                glow: '0 0 25px rgba(255, 217, 183, 0.5)',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-14px)' },
                },
                twinkle: {
                    '0%, 100%': { opacity: 0.3, transform: 'scale(0.9)' },
                    '50%': { opacity: 1, transform: 'scale(1.15)' },
                },
                pop: {
                    '0%': { transform: 'scale(0.9)', opacity: 0 },
                    '60%': { transform: 'scale(1.05)', opacity: 1 },
                    '100%': { transform: 'scale(1)' },
                },
            },
            animation: {
                float: 'float 6s ease-in-out infinite',
                twinkle: 'twinkle 2.4s ease-in-out infinite',
                pop: 'pop 0.4s ease-out',
            },
        },
    },
    plugins: [],
};
