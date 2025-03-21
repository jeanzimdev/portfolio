# Portfolio - Jean Felipe

![Portfolio Screenshot](screenshots/portfolio.png)

Um site de portfolio moderno e responsivo desenvolvido com HTML, CSS e JavaScript, utilizando bibliotecas selecionadas para melhorar a experiência do usuário.

## Características

- **Design Responsivo**: Layout adaptável para diversos tamanhos de tela
- **Modo Escuro/Claro**: Alternância de tema com persistência de preferência
- **Animações Suaves**: Transições e animações para uma experiência refinada
- **Performance Otimizada**: Carregamento eficiente de recursos e imagens
- **Formulário de Contato**: Sistema de formulário com validação e feedback usando EmailJS
- **Acessibilidade**: Atributos ARIA e navegação por teclado

## Tecnologias Utilizadas

- HTML5 semântico
- CSS3 (Flexbox, Grid, Variáveis CSS)
- JavaScript 
- EmailJS para envio de emails sem backend
- WOW.js para animações de scroll
- Animate.css para efeitos de entrada
- Font Awesome para ícones
- Variáveis CSS para temas dinâmicos

## Sistema de Contato

O formulário de contato utiliza o [EmailJS](https://www.emailjs.com/) para envio de emails diretamente do frontend, sem necessidade de backend próprio. Caso prefira usar um servidor PHP para processar os emails, siga estas opções:

### Opção 1: EmailJS (implementação atual)
- Serviço gratuito para até 200 emails por mês
- Não requer servidor próprio
- Fácil implementação e manutenção

### Opção 2: Servidor PHP (alternativa)
- Caso tenha hospedagem com suporte a PHP, você pode substituir a implementação do EmailJS
- Crie um arquivo `send_email.php` na raiz do projeto
- Modifique o JavaScript para enviar o formulário para este arquivo PHP
- Ideal para quem busca maior controle sobre o processamento de emails

## Estrutura do Projeto

```
portfolio/
│
├── img/                  # Imagens e ícones
├── index.html            # Página principal
├── styles.css            # Estilos globais
├── screenshots/          # Screenshots do projeto
└── README.md             # Documentação
```

## Instalação

1. Clone o repositório:
```bash
git clone https://github.com/jeanzimdev/portfolio.git
```

2. Navegue até a pasta do projeto:
```bash
cd portfolio
```

3. Abra o arquivo `index.html` em seu navegador ou utilize um servidor local.

## Desenvolvedor

**Jean Felipe** - Desenvolvedor Front-End

- [GitHub](https://github.com/jeanzimdev)
- [LinkedIn](https://www.linkedin.com/in/jean-felipe-martin-991568262/)