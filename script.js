document.getElementById('myForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Zabránění odeslání formuláře před validací
  
    // Vyprázdnění předchozích hlášení o chybách
    document.getElementById('alert-container').innerHTML = '';
    
    let errors = [];
    
    // Získání hodnot z formuláře
    const jmeno = document.getElementById('jmeno').value;
    const prijmeni = document.getElementById('prijmeni').value;
    const email = document.getElementById('email').value;
    const telnumber = document.getElementById('telnumber').value;
    const adresa = document.getElementById('adresa').value;
    const mesto = document.getElementById('mesto').value;
    const zprava = document.getElementById('zprava').value;
    
    // Kontrola povinných polí
    
    if (!jmeno) errors.push('Jméno je povinné.');
    if (!prijmeni) errors.push('Příjmení je povinné.');
    if (!email) errors.push('E-mail je povinný.');
    if (!telnumber) errors.push('Telefoní číslo je povinné.');
    if (!adresa) errors.push('Adresa je povinná.');
    if (!mesto) errors.push('Město je povinné.');
    if (!zprava) errors.push('Zpráva je povinná.');
  
    // Kontrola formátu e-mailu
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (email && !emailPattern.test(email)) {
        errors.push('E-mail není ve správném formátu.');
    }
      if (zprava.length > 255) {
      errors.push('Zpráva nesmí obsahovat více než 255 znaků.');
      }
    // Kontrola formátu telefonního čísla
    const telPattern = /^\+?\d{9,15}$/; // +420123456789 nebo 420123456789
    if (telnumber && !telPattern.test(telnumber)) {
        errors.push('Telefonní číslo není ve správném formátu.');
    }
  
    // Pokud jsou nějaké chyby, zobrazíme je
    if (errors.length > 0) {
        let errorMessages = errors.map(error => `<p>${error}</p>`).join('');
        document.getElementById('alert-container').innerHTML = errorMessages;
    } else {
        // Pokud nejsou žádné chyby, můžeme formulář odeslat (pokud to bude potřeba)
        // this.submit();  // Pro odeslání formuláře je možné odkomentovat tuto řádku
        alert('Formulář je správně vyplněn!');
    }
  });