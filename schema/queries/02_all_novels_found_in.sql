SELECT novel.title
FROM novel
join person_novel ON novel.id=person_novel.novel_id
join person ON person.id=person_novel.person_id
WHERE person.first_name = 'Solomon'
AND person.last_name = 'Bridgetower';
