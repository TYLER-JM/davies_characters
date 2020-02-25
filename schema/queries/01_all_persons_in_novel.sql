SELECT person.first_name, person.last_name
FROM person
join person_novel ON person.id = person_novel.person_id
join novel ON novel.id = person_novel.novel_id
WHERE novel.title = 'Fifth Business';
