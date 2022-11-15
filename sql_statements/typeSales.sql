SELECT iType, COUNT(iType), SUM(iOutletSales) AS totalSales, AVG(iOutletSales) AS averageSales, RANK() OVER w AS 'rank',
         DENSE_RANK() OVER w AS 'denseRank'
FROM typeSales
GROUP BY iType
WINDOW w AS (ORDER BY iType);

