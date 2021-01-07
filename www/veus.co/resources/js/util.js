export default function formatCurrency(num) {
    console.log(num);
  return "$" + Number(parseFloat(num).toFixed(1)).toLocaleString() + " ";
}
