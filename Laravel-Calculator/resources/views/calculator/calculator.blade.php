<form action=" {{ route('calculate') }}" method="POST">

    @csrf

    <input type="text" name="operand1" placeholder="Enter number" required>
    <select name="operator" required>
        <option value="add">+</option>
        <option value="subtract">-</option>
        <option value="multiply">*</option>
        <option value="divide">/</option>
    </select>

    <input type="text" name="operand2" placeholder="Enter second number" required>

    <button type="submit">Calculate</button>



</form>
