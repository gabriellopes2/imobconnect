INSERT INTO cidade (id, descricao, uf, ativo)
SELECT c.id, c.nome, e.uf, true FROM cidade_temp c
inner join estado_temp e on c.uf = e.id;
