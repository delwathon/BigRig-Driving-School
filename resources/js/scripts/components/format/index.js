export function format(num) {
  const number = parseFloat(num);
  if (isNaN(number)) {
    return '0.00';
  }

  const formatter = new Intl.NumberFormat('en-US', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  });
  const formattedNumber = formatter.format(number);

  return formattedNumber;
}
