# Jhey-blogg

# Del 1: MySQL
### Skapa tabellen “posts”, i en databas med namnet “blog”

### Tabellen skall innehålla följande kolumner och inställningar(datatyp, defaultvärde, nycklar):

  - id, int(9), primary key
  - title, varchar(50)
  - content, text
  - author, varchar(50)
  - published_date, timestamp, CURRENT_TIMESTAMP
  
# Del 2: Användargränssnitt för administratör
### Skapa en sida som gör det möjligt för en administratör att hantera innehållet i bloggen. 

### Följande funktionalitet skall innehålla i användargränssnittet:

  - Lista alla blogginlägg
  - Skapa nya inlägg  
    - Formuläret skall ha fälten title, author och content.
  - Radera ett inlägg
  
# Del 3: Den publika sidan för besökare

- Lista alla blogginlägg
    - Title, content (endast första ca 100 karaktärer, med en “Read more”-länk), author, published_date
- Visa enskilt inlägg
    - Title, content (hela inlägget), author, published_date
