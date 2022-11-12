SELECT iType, iFatContent, AVG(iOutletSales) AS averageSales
FROM typeFatSales
GROUP BY iType, iFatContent
ORDER BY iType, iFatContent;