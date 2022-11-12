SELECT iType, iFatContent, AVG(iOutletSales) AS averageSales
FROM typeFatSales
GROUP BY iType, iFatContent WITH ROLLUP
ORDER BY iType, iFatContent;