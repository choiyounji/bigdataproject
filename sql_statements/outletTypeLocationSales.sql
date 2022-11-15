SELECT oLocationType, oType, SUM(iOutletSales) AS totalSales
FROM outletTypeLocationSales
GROUP BY oLocationType, oType
ORDER BY oLocationType, oType;