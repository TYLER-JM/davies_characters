SELECT novel.title, novel.year_published
FROM novel
join person_novel ON novel.id=person_novel.novel_id
WHERE person_novel.person_id = 4
-- AND person.last_name = 'Bridgetower';
