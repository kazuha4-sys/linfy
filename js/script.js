                // Seleciona o botão e o corpo
                const toggleButton = document.getElementById('toggleMode');
                const body = document.body;
                
                // Alterna entre modos
                toggleButton.addEventListener('click', () => {
                    if (body.classList.contains('dark-mode')) {
                        body.classList.remove('dark-mode');
                        body.classList.add('light-mode');
                    } else {
                        body.classList.remove('light-mode');
                        body.classList.add('dark-mode');
                    }
                });
                
                // Define o modo inicial com base no sistema ou salva no localStorage
                window.onload = () => {
                    const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)").matches;
                    const storedMode = localStorage.getItem("mode");
                
                    if (storedMode) {
                        body.classList.add(storedMode);
                    } else {
                        body.classList.add(prefersDarkScheme ? "dark-mode" : "light-mode");
                    }
                
                    toggleButton.innerText = body.classList.contains('dark-mode') 
                        ? "Mudar para Claro" 
                        : "Mudar para Escuro";
                };
                
                // Atualiza texto do botão ao alternar
                toggleButton.addEventListener('click', () => {
                    const mode = body.classList.contains('dark-mode') ? "dark-mode" : "light-mode";
                    toggleButton.innerText = mode === "dark-mode" ? "Mudar para Claro" : "Mudar para Escuro";
                    localStorage.setItem("mode", mode);
                });