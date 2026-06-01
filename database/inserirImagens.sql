-- use 1 de cada vez para evitar erros de chave estrangeira
UPDATE produtos 
SET imagem = '/VarejoQualitas/app/views/img/aquecedor.jpg' 
WHERE nome LIKE '%Aquecedor%';

UPDATE produtos 
SET imagem = '/VarejoQualitas/database/img/Q400-2.jpg'
WHERE nome LIKE '%Q300%';

UPDATE produtos 
SET imagem = '/VarejoQualitas/database/img/Q400-0'
WHERE nome LIKE '%Aquecedor%';