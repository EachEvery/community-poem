module.exports = {
    theme: {
        fontFamily: {
            serif: ["calluna", "serif"],
            sans: ["Work Sans", "sans-serif"],
            cursive: ["Homemade Apple", "cursive"],
            display: ["bureau-grot-condensed", "sans-serif"]
        },
        extend: {
            colors: {
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
                "100vh": "100vh"
            },
            fontSize: {
                "8xl": "6rem",
                "9xl": "7rem",
                "10xl": "11rem"
            }
        }
    },
    variants: {
        opacity: ["responsive", "hover"]
    },
    plugins: []
};
