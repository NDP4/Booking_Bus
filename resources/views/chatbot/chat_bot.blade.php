<script type="module">
    import Chatbot from "https://cdn.jsdelivr.net/npm/flowise-embed/dist/web.js"
    Chatbot.init({
        chatflowid: "37d58456-b506-4f39-b083-99b4cbf8e8a1",
        apiHost: "http://localhost:3000",
        chatflowConfig: {
            // topK: 2
        },
        theme: {
            button: {
                backgroundColor: "#3B81F6",
                right: 20,
                bottom: 20,
                size: 48, // small | medium | large | number
                dragAndDrop: true,
                iconColor: "white",
                customIconSrc: "https://raw.githubusercontent.com/walkxcode/dashboard-icons/main/svg/google-messages.svg",
                autoWindowOpen: {
                    autoOpen: true, //parameter to control automatic window opening
                    openDelay: 2, // Optional parameter for delay time in seconds
                    autoOpenOnMobile: false, //parameter to control automatic window opening in mobile
                    },
            },
            tooltip: {
                showTooltip: true,
                tooltipMessage: 'Halo! 👋',
                tooltipBackgroundColor: 'black',
                tooltipTextColor: 'white',
                tooltipFontSize: 16,
            },
            chatWindow: {
                showTitle: true,
                title: 'kostumer servis',
                // titleAvatarSrc: 'https://raw.githubusercontent.com/walkxcode/dashboard-icons/main/svg/google-messages.svg',
                titleAvatarSrc: 'http://localhost:8000/images/admin.png',
                showAgentMessages: true,
                welcomeMessage: 'Selamat datang! Saya siap membantu Anda.',
                errorMessage: 'Terjadi kesalahan. Mohon coba lagi.',
                backgroundColor: "#ffffff",
                backgroundImage: 'enter image path or link', // If set, this will overlap the background color of the chat window.
                height: 700,
                width: 400,
                fontSize: 16,
                //starterPrompts: ['What is a bot?', 'Who are you?'], // It overrides the starter prompts set by the chat flow passed
                starterPromptFontSize: 15,
                clearChatOnReload: false, // If set to true, the chat will be cleared when the page reloads.
                botMessage: {
                    backgroundColor: "#f7f8ff",
                    textColor: "#303235",
                    showAvatar: true,
                    avatarSrc: "http://localhost:8000/images/logo_rizky_putra_168.svg",
                },
                userMessage: {
                    backgroundColor: "#3B81F6",
                    textColor: "#ffffff",
                    showAvatar: true,
                    avatarSrc: "https://raw.githubusercontent.com/zahidkhawaja/langchain-chat-nextjs/main/public/usericon.png",
                },
                textInput: {
                    placeholder: 'Tulis pertanyaan Anda',
                    backgroundColor: '#ffffff',
                    textColor: '#303235',
                    sendButtonColor: '#3B81F6',
                    maxChars: 50,
                    maxCharsWarningMessage: 'Anda melebihi batas karakter. Silakan input kurang dari 50 karakter.',
                    autoFocus: true, // If not used, autofocus is disabled on mobile and enabled on desktop. true enables it on both, false disables it on both.
                    sendMessageSound: true,
                    // sendSoundLocation: "send_message.mp3", // If this is not used, the default sound effect will be played if sendSoundMessage is true.
                    receiveMessageSound: true,
                    // receiveSoundLocation: "receive_message.mp3", // If this is not used, the default sound effect will be played if receiveSoundMessage is true.
                },
                feedback: {
                    color: '#303235',
                },
                footer: {
                    textColor: '#303235',
                    text: 'Dibuat oleh',
                    company: 'Dwi And Dito',
                    companyLink: 'https://flowiseai.com',
                }
            }
        }
    })
</script>
