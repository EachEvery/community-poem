module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/**/**/*.vue"
    ],
    theme: {
        fontFamily: {
            serif: ["calluna", "serif"],
            sans: ["Work Sans", "sans-serif"],
            cursive: ["Homemade Apple", "cursive"],
            display: ["bureau-grot-condensed", "sans-serif"]
        },
        extend: {
            colors: {
                primary: "var(--primary, #1E6043)",
                secondary: "var(--secondary, #FFFDD5)",
                green: {
                    "100": "#EBFFE6",
                    "900": "#1E6043"
                },
                yellow: {
                    "900": "#FDDFB4",
                    "100": "#FFFDD5"
                },
                blue: {
                    "100": "#E0F5FF"
                }
            },
            spacing: {
                "70": "20rem",
                "50vw": "50vw",
                "15vh": "15vh",
                "22vh": "22vh",
                "100vh": "100vh",
                "28": "7rem"
            },
            fontSize: {
                xxs: "0.625rem",
                "8xl": "6rem",
                "9xl": "7rem",
                "10xl": "11rem"
            },
            screens: {
                // xl: "1600px"
            }
        }
    },
    variants: {
        opacity: ["responsive", "hover"]
    },
    plugins: []
};
